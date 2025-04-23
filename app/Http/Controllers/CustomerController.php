<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCustomerRequest;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Customer;


class CustomerController extends Controller
{
    public function index(Request $request){
        $customers =
        Customer::searchCustomers($request->search)
         ->select('id', 'name', 'kana', 'tel')->paginate(50);

         return Inertia::render('Customers/Index', [
         'customers' => $customers
         ]);
    }

    public function create(){
    return Inertia::render('Customers/Create');
    }

    public function store(StoreCustomerRequest $request)
    {
    Customer::create([
    'name' => $request->name,
    'kana' => $request->kana,
    'tel' => $request->tel,
    'email' => $request->email,
    'postcode' => $request->postcode,
    'address' => $request->address,
    'birthday' => $request->birthday,
    'gender' => $request->gender,
    'memo' => $request->memo,
    ]);
    return to_route('customers.index')
    ->with([
    'message' => '登録しました。',
    'status' => 'success'
    ]);
    }
}
