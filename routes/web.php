<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\InertiaTestController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\CustomerController;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\PurchaseController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// ⭐ これを resource の上に書くことで、Inertia専用のcreateルートを明示的に先に定義
Route::get('/customers/create', [CustomerController::class, 'create'])
    ->name('customers.create')
    ->middleware(['auth', 'verified']);

Route::get('/inertia-test', function () {
    return Inertia::render('InertiaTest');
    }
);

Route::get('/inertia/index', [InertiaTestController::class, 'index'])->name('inertia.index');
Route::get('/inertia/show/{id}', [InertiaTestController::class,'show'])->name('inertia.show');
Route::post('/inertia', [InertiaTestController::class, 'store'])->name('inertia.store');
Route::get('/inertia/create', [InertiaTestController::class,'create'])->name('inertia.create');
Route::delete('/inertia/{id}', [InertiaTestController::class, 'delete'])->name('inertia.delete');
Route::get('/component-test', function () {
    return Inertia::render('ComponentTest');
   });
Route::resource('items', ItemController::class)
->middleware(['auth', 'verified']);


Route::resource('customers', CustomerController::class)
    ->except(['show', 'edit', 'update', 'destroy'])
    ->middleware(['auth', 'verified']);

Route::resource('purchases', PurchaseController::class)
->middleware(['auth', 'verified']);

Route::get('/api/zipcloud/search', function (\Illuminate\Http\Request $request) {
    $zipcode = $request->query('zipcode');
    $response = Http::get("https://zipcloud.ibsnet.co.jp/api/search", [
        'zipcode' => $zipcode,
    ]);
    return $response->json();
});

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
