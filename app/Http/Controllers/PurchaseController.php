<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Http\Requests\StorePurchaseRequest;
use App\Http\Requests\UpdatePurchaseRequest;
use Inertia\Inertia;
use App\Models\Customer;
use App\Models\Item;
use Illuminate\Support\Facades\DB;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // 一覧未実装
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $customers = Customer::select('id', 'name', 'kana')->get();
        $items = Item::select('id', 'name', 'price')->where('is_selling', true)->get();

        return Inertia::render('Purchases/Create', [
            'customers' => $customers,
            'items' => $items
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */


    public function store(StorePurchaseRequest $request)
    {
        DB::beginTransaction();

        try {
            // 1. 合計金額を計算
            $total = 0;

            foreach ($request->items as $itemData) {
                logger("attach対象: item_id = {$itemData['id']}, quantity = {$itemData['quantity']}");
                $item = Item::findOrFail($itemData['id']);
                $total += $item->price * $itemData['quantity'];
            }

            // 2. 購入情報を保存
            $purchase = Purchase::create([
                'customer_id' => $request->customer_id,
                'status' => 'new',
                'total_price' => $total,
            ]);

            // 3. 中間テーブルに商品を紐づけ（item_purchase）
            foreach ($request->items as $itemData) {
                $purchase->items()->attach($itemData['id'], [
                    'quantity' => $itemData['quantity'],
                ]);
            }

            DB::commit();

            logger('受け取った items:', $request->items);

            return redirect()->route('purchases.create')->with('message', '購入が登録されました！');

        } catch (\Exception $e) {
            DB::rollback();

            logger()->error('購入登録エラー: ' . $e->getMessage());
            logger($request->items);

            return redirect()->route('purchases.create')->with('error', '登録に失敗しました。もう一度お試しください。');
        }
    }
}
