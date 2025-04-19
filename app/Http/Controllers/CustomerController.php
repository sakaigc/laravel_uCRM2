<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Customer;


class CustomerController extends Controller
{
    public function index(){
        return Inertia::render('Customers/Index', [
        'customers' => Customer::select('id', 'name', 'kana', 'tel')->paginate(50),
        ]);
       }
}
