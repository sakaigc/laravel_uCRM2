<?php

namespace App\Http\Controllers;

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
}
