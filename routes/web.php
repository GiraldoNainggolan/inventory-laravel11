<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('register');
// });

Route::get('/', [UserController::class, 'index']);
Route::get('/index', [UserController::class, 'index']);
Route::get('/login', [UserController::class, 'login']);
Route::post('/login', [UserController::class, 'login_post']);
Route::get('/logout', [UserController::class, 'logout']);
Route::get('/emp_registration', [UserController::class, 'emp_registration']);
Route::post('/emp_registration', [UserController::class, 'emp_registration_post']);
Route::get('/emp_list', [UserController::class, 'emp_list']);

Route::get('/add_item', [InventoryController::class, 'add_item']);
Route::post('/add_item', [InventoryController::class, 'add_item_post']);
Route::get('/list_item', [InventoryController::class, 'list_item']);
Route::get('/list_item_status', [InventoryController::class, 'list_item_status']);
Route::get('/list_item_status_change/{id}/{item_status}', [InventoryController::class, 'list_item_status_change']);
Route::post('/get_item', [InventoryController::class, 'get_item']);
Route::post('/edit_item', [InventoryController::class, 'edit_item']);
Route::post('/edit_item_post', [InventoryController::class, 'edit_item_post']);

Route::get('/add_purchase', [PurchaseController::class, 'add_purchase']);
Route::post('/add_purchase', [PurchaseController::class, 'add_purchase_post']);
Route::post('/fetch_vendor_details', [PurchaseController::class, 'fetch_vendor_details']);
Route::post('/fetch_item_details', [PurchaseController::class, 'fetch_item_details']);
Route::get('/list_purchase', [PurchaseController::class, 'list_purchase']);

Route::get('/add_vendor', [VendorController::class, 'add_vendor']);
Route::post('/add_vendor', [VendorController::class, 'add_vendor_post']);
Route::get('/list_vendor', [VendorController::class, 'list_vendor']);
Route::post('/get_vendor', [VendorController::class, 'get_vendor']);
Route::post('/edit_vendor', [VendorController::class, 'edit_vendor']);
Route::post('/edit_vendor_post', [VendorController::class, 'edit_vendor_post']);

Route::get('/add_customer', [CustomerController::class, 'add_customer']);
Route::post('/add_customer', [CustomerController::class, 'add_customer_post']);
Route::get('/list_customer', [CustomerController::class, 'list_customer']);
Route::post('/get_customer', [CustomerController::class, 'get_customer']);
Route::post('/edit_customer', [CustomerController::class, 'edit_customer']);
Route::post('/edit_customer_post', [CustomerController::class, 'edit_customer_post']);

Route::get('/add_sale', [SaleController::class, 'add_sale']);
Route::post('/add_sale', [SaleController::class, 'add_sale_post']);
Route::post('/fetch_customer_details', [SaleController::class, 'fetch_customer_details']);
// Route::post('/fetch_item_details', [InventoryController::class, 'fetch_item_details']);
Route::get('/list_sale', [SaleController::class, 'list_sale']);

Route::get('/export', [InventoryController::class, 'exportInventory']);
Route::get('/import', [InventoryController::class, 'importInventory']);
Route::post('/import', [InventoryController::class, 'importInventoryPost']);
Route::get('/download_pdf', [InventoryController::class, 'downloadPDF']);



