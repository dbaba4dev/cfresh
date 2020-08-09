<?php

use Illuminate\Support\Facades\Route;

require_once __DIR__ .'/front_routes.php';
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

Route::get('chart/{year}', 'AdminController@fetch_chart_data');
Route::post('admin/chart/fetch_data', 'AdminController@fetch_data')->name('fetch_data');

/*======================User Login/Registration Route==================================*/
Route::match(['get','post'],'/user-register','UsersController@register')->name('user.register');

/*======================================== Front Home Route =========================================*/
//Route::get('/', 'IndexController@index')->name('home');

/*======================================== Product Detail Route =========================================*/
Route::get('/product/{id}', 'ProductsController@detail')->name('product.detail');

/*======================Add Cart Route (user)==================================*/
Route::match(['get','post'],'/add_to_cart','ProductsController@addtoCart')->name('add-cart');

/*======================Cart Page Route (Admin)==================================*/
//Route::match(['get','post'],'/cart','ProductsController@cart')->name('cart');

/*======================Delete a cart Route==================================*/
Route::get('/card/delete-product/{id}','ProductsController@deleteCartProduct')->name('product.deleteCart');

/*======================Update Product Quantity Route==================================*/
Route::get('/card/update-quantity/{id}/{quantity}','ProductsController@updateCartQuantity')->name('product.updateCart');

/*======================User Registration Route==================================*/
Route::get('/login-register','UsersController@showLoginRegister')->name('user.LoginRegisterForm');

/*======================User Post Registration Form Route==================================*/
Route::post('/user-register','UsersController@register')->name('user.PostRegisterForm');

/*======================User Show $ Post Login Route==================================*/
//Route::match(['get','post'],'/user-login','ProductsController@login')->name('user.login');
//Route::match(['get','post'],'/user-login','UsersController@login')->name('user.login');

/*======================Forgot Password Route==================================*/
Route::match(['get','post'],'/forgot-password','UsersController@forgotPassword')->name('user.forgotPassword');

/*======================Display Local Government of each state Route==================================*/
Route::get('state/{id}', 'UsersController@getLgas');



/*====================== Confirm Account==================================*/
Route::get('/confirm/{code}','UsersController@confirmAccount')->name('confirmAccount');

//All Routes After login
Route::group(['middleware'=>['frontLogin']], function (){
    /*====================== User Account Route==================================*/
    Route::match(['get','post'],'/account','UsersController@account')->name('user.account');

    /*====================== Check Password for user account Route==================================*/
    Route::post('/check-password','UsersController@checkPassword')->name('user.account.password');

    /*====================== Update User Password for user account Route==================================*/
    Route::post('/update-user-password','UsersController@updatePassword')->name('user.update.password');



    /*====================== Order Review Route==================================*/
    Route::match(['get','post'],'/order-review','ProductsController@orderReview')->name('order.review');

    /*======================Place Order Route==================================*/
    Route::match(['get','post'],'/place-order','ProductsController@placeOrder')->name('place.order');

    /*======================Thanks Page Order Route==================================*/
    Route::get('/thanks','ProductsController@thanks')->name('thanks');

    /*======================User Order Page Order Route==================================*/
    Route::get('/orders','ProductsController@userOrders')->name('user.order');

    /*====================== Order detail Page Order Route==================================*/
    Route::get('/orders/{id}','ProductsController@ordersDetails')->name('ordersDetails');
});


/*======================User logout Route==================================*/
Route::get('/user-logout','UsersController@logout')->name('user.logout');

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

/*======================================== Admin Login Route =========================================*/
Route::match(['get','post'],'/admin','AdminController@login')->name('admin.login');

/*======================================== Admin Logout Route =========================================*/
Route::get('/admin-logout','AdminController@logout')->name('admin.logout');


Route::group(['prefix'=>'admin', 'middleware'=>['admin']], function (){
//    Route::get('/dashboard', 'HomeController@dashboard')->name('dashboard');
    Route::get('/dashboard','AdminController@dashboard')->name('admin.dashboard');

    /*======================Admin Management Route (Admin)==================================*/
    Route::get('/admins/view-admins','AdminController@viewAdmins')->name('viewAdmins');
    Route::match(['get','post'],'/admins/add-admin','AdminController@addAdmin')->name('addAdmin');
    Route::match(['get','post'],'/admins/edit-admin/{id}','AdminController@editAdmin')->name('editAdmin');

    /*-----------------------------------------USERS ROUTE START----------------------------------------*/
//    Route::get('/users', ['uses'=>'AdminController@showAdmins', 'as'=>'show.users']);

    /*======================View Users Order Route (Admin)==================================*/
    Route::get('/view-users', ['uses'=>'UsersController@viewUsers', 'as'=>'admin.viewUsers']);

    /*======================Admin Order Invoice Route (Admin)==================================*/
    Route::get('/view-order-invoice/{id}','ProductsController@viewOrderInvoice')->name('admin.viewOrderInvoice');
    Route::get('/admin/view-pdf-invoice/{id}','ProductsController@viewPdfInvoice')->name('admin.viewPdfInvoice');

/*-----------------------------------------USERS ROUTE END----------------------------------------*/

/*-----------------------------------------EMPLOYEES CATEGORIES ROUTE END----------------------------------------*/
    Route::get('/employee/categories', ['uses'=>'CategoriesController@index', 'as'=>'categories']);

    Route::post('/employee/category/store', ['uses'=>'CategoriesController@store', 'as'=>'category.store']);

    Route::get('/employee/category/edit/{id}', ['uses'=>'CategoriesController@edit', 'as'=>'category.edit']);

    Route::post('/employee/category/update/{id}', ['uses'=>'CategoriesController@update', 'as'=>'category.update']);

    Route::get('/employee/category/delete/{id}', ['uses'=>'CategoriesController@destroy', 'as'=>'category.delete']);
/*-----------------------------------------EMPLOYEES CATEGORIES ROUTE END----------------------------------------*/

/*-----------------------------------------EMPLOYEES ROUTE START----------------------------------------*/
    Route::get('/employee/index', ['uses'=>'EmployeesController@index', 'as'=>'employees']);

    Route::get('/employee/create', ['uses'=>'EmployeesController@create', 'as'=>'employee.create']);

    Route::post('/employee/store', ['uses'=>'EmployeesController@store', 'as'=>'employee.store']);

    Route::match(['get','post'],'/employee/edit-sales/{id}', ['uses'=>'EmployeesController@edit_sales', 'as'=>'employee.edit']);
    Route::match(['get','post'],'/employee/edit-account/{id}', ['uses'=>'EmployeesController@edit_account', 'as'=>'employee.edit.account']);


    Route::post('/employee/update/{id}', ['uses'=>'EmployeesController@update', 'as'=>'employee.update']);

    Route::get('/employee/delete/{id}', ['uses'=>'EmployeesController@delete', 'as'=>'employee.delete']);

    Route::get('/employee/deactivated', ['uses'=>'EmployeesController@trashes', 'as'=>'trashes']);

    Route::get('/employee/deactivate/{id}', ['uses'=>'EmployeesController@destroy', 'as'=>'employee.deactivated']);

    Route::get('/employee/restore/{id}', ['uses'=>'EmployeesController@restore', 'as'=>'employee.restore']);

    Route::post('/employee/profile/update/{id}',['uses'=>'EmployeesController@update', 'as'=>'employee.profile.update']);


/*-----------------------------------------EMPLOYEES ROUTE END----------------------------------------*/

    /*----------------------------------------- Payments ROUTE END----------------------------------------*/
    Route::get('/pay/employee', ['uses'=>'PaymentsController@settle', 'as'=>'settlement']);
    Route::get('paid/employee/{id}/{balance}/{cash_type}/{employee_id}', ['uses'=>'PaymentsController@pay', 'as'=>'pay']);
    Route::get('/employee/commission', ['uses'=>'PaymentsController@commission', 'as'=>'commission']);



    Route::get('/employee/payments', ['uses'=>'PaymentsController@index', 'as'=>'payments']);
//    Route::get('/cases/create', ['uses'=>'CasesController@create', 'as'=>'case.create']);
//
    Route::post('/employee/payment/store', ['uses'=>'PaymentsController@store', 'as'=>'payment.store']);

    Route::post('/employee/payment/update/{id}', ['uses'=>'PaymentsController@update', 'as'=>'payment.update']);

    Route::get('/employee/payment/delete/{id}', ['uses'=>'PaymentsController@destroy', 'as'=>'payment.delete']);
    /*-----------------------------------------Case ROUTE END----------------------------------------*/

/*----------------------------------------- Raw Material ROUTE END----------------------------------------*/
    Route::get('/stock/materials', ['uses'=>'MaterialsController@index', 'as'=>'materials']);
//    Route::get('/stock/materials', ['uses'=>'StocksController@matrial', 'as'=>'materials']);
//    Route::post('/stock/materials', ['uses'=>'StocksController@createMatrial', 'as'=>'material.create']);
//
    Route::post('/stock/material/store', ['uses'=>'MaterialsController@store', 'as'=>'material.store']);
    Route::post('/material/upload', ['uses'=>'StocksController@uploadSubmit', 'as'=>'uploadSubmit']);
//
    Route::post('/stock/material/update/{id}', ['uses'=>'MaterialsController@update', 'as'=>'stock.update']);
//
    Route::get('/material/delete/{id}', ['uses'=>'MaterialsController@destroy', 'as'=>'material.delete']);
/*-----------------------------------------Raw Material ROUTE END----------------------------------------*/

    /*----------------------------------------- STOCK ROUTE END----------------------------------------*/
    Route::match(['get','post'],'/stocks', ['uses'=>'StocksController@index', 'as'=>'stocks']);
    Route::post('edit/batch/{id}', ['uses'=>'StocksController@editBatch', 'as'=>'admin.editBatch']);
    Route::match(['get','post'],'stock/history', ['uses'=>'StocksController@viewPage', 'as'=>'stocks.history']);
    Route::get('pdfview','StocksController@pdfview')->name('PDF_report');

    Route::get('/stock/delete/{id}', ['uses'=>'StocksController@destroy', 'as'=>'stock.delete']);

    Route::get('selected-material',['uses'=>'StocksController@selected_material', 'as'=>'selected.material']);
    /*-----------------------------------------STOCK ROUTE END----------------------------------------*/

    /*====================== Expenses/Income Route (Admin)==================================*/
    Route::match(['get','post'],'/finances/income', ['uses'=>'FinancesController@income', 'as'=>'finance.income']);
    Route::match(['get','post'],'finances/income/search', ['uses'=>'FinancesController@viewIncomePage', 'as'=>'income.search']);
    Route::get('finances/bank-cash', ['uses'=>'FinancesController@getCash2Bank', 'as'=>'cash.bank']);
    Route::post('finances/bank-cash', ['uses'=>'FinancesController@cash2Bank', 'as'=>'postCash.bank']);
    Route::post('/finances/cash-to-bank-search', ['uses'=>'FinancesController@getCash2Bank', 'as'=>'cash.to.bank.search']);

    Route::get('income/pdfview','FinancesController@pdf_income_view')->name('income-report.pdf');
    Route::post('finances/teller/{id}','FinancesController@teller')->name('teller');

    Route::get('/finances/cash-from-bank', ['uses'=>'FinancesController@getcashFromBank', 'as'=>'cash.from.bank']);
    Route::post('/finances/cash-from-bank-search', ['uses'=>'FinancesController@getcashFromBank', 'as'=>'cash.from.bank.search']);
    Route::post('/finances/cash-from-bank', ['uses'=>'FinancesController@cashFromBank', 'as'=>'postCash.from.bank']);

//    Route::match(['get','post'],'finances/cash-from-bank', ['uses'=>'FinancesController@cashFromBank', 'as'=>'cash.from.bank']);

    Route::post('/finances/expense', ['uses'=>'FinancesController@expense', 'as'=>'finance.expense']);
    Route::match(['get','post'],'/finances/expense/search', ['uses'=>'FinancesController@viewExpensePage', 'as'=>'expense.search']);
    Route::match(['get','post'],'/check-balance', ['uses'=>'FinancesController@checkBalanace', 'as'=>'check.balance']);
    Route::get('/question/yes/{id}', ['uses'=>'FinancesController@yesQuestion', 'as'=>'yes_question']);
    Route::get('/question/no/{id}', ['uses'=>'FinancesController@noQuestion', 'as'=>'no_question']);
    Route::get('expenses/pdfview','FinancesController@pdf_expenses_view')->name('expenses-report.pdf');

    Route::post('/finances/credit', ['uses'=>'FinancesController@credit', 'as'=>'finance.credit']);


    /*----------------------------------------- Product ROUTE END----------------------------------------*/
    Route::match(['get','post'],'operation/move/product', ['uses'=>'ProductsController@finishedProducts', 'as'=>'products.finished']);
    Route::match(['get','post'],'operation/add-damages', ['uses'=>'MaterialsController@damages', 'as'=>'damages']);
    Route::match(['get','post'],'operation/view-damages', ['uses'=>'MaterialsController@view_damages', 'as'=>'damages.search']);
    Route::get('operation/damages/pdfview','MaterialsController@pdf_damages_view')->name('damages-report.pdf');

    Route::get('/products', ['uses'=>'ProductsController@index', 'as'=>'products']);
    Route::get('/product/create', ['uses'=>'ProductsController@create', 'as'=>'product.create']);
    Route::match(['get','post'],'/store/view', ['uses'=>'ProductsController@productStore', 'as'=>'store']);

    Route::post('/product/store', ['uses'=>'ProductsController@store', 'as'=>'product.store']);
    Route::get('/product/delete/{id}', ['uses'=>'ProductsController@destroy', 'as'=>'product.delete']);


    Route::get('/orders', ['uses'=>'OrdersController@index', 'as'=>'orders']);
    Route::get('/order/create', ['uses'=>'OrdersController@create', 'as'=>'order.create']);
    Route::post('/order/store', ['uses'=>'OrdersController@store', 'as'=>'order.store']);
    /*-----------------------------------------STOCK ROUTE END----------------------------------------*/

    /*----------------------------------------- Cases ROUTE END----------------------------------------*/
    Route::get('/cases', ['uses'=>'CasesController@index', 'as'=>'cases']);
    Route::get('/cases/create', ['uses'=>'CasesController@create', 'as'=>'case.create']);

    Route::post('/case/store', ['uses'=>'CasesController@store', 'as'=>'case.store']);
    Route::match(['get','post'],'/edit-product/{id}','CasesController@edit')->name('admin.editProduct');
//    Route::post('/case/update/{id}', ['uses'=>'CasesController@update', 'as'=>'case.update']);

    Route::get('/case/delete/{id}', ['uses'=>'CasesController@destroy', 'as'=>'case.delete']);
    /*-----------------------------------------Case ROUTE END----------------------------------------*/

    /*-----------------------------------------SETTINGS ROUTE BEGINGS----------------------------------------*/
    Route::get('/settings', ['uses'=>'SettingsController@index', 'as'=>'settings']);
    Route::post('/settings/update', ['uses'=>'SettingsController@update_info', 'as'=>'settings.info.update']);
    Route::post('/settings/update/commission', ['uses'=>'SettingsController@update_commission', 'as'=>'settings.commission.update']);
    /*-----------------------------------------SETTINGS ROUTE END----------------------------------------*/

    /*======================Add Coupons Route (User)==================================*/
    Route::match(['get','post'],'/coupons/add','CouponsController@addCoupon')->name('admin.addCoupon');

    /*======================View Coupons Route (User)==================================*/
    Route::get('/coupons/view','CouponsController@viewCoupons')->name('admin.viewCoupons');

    /*======================Delete Coupons Route (User)==================================*/
    Route::get('/coupons/delete/{id}','CouponsController@deleteCoupon')->name('admin.deleteCoupon');

    /*======================Update Coupons Route (User)==================================*/
    Route::match(['get','post'],'/coupons/update/{id}','CouponsController@updateCoupon')->name('admin.editCoupon');


    /*======================Add CMS Pages (admin)==================================*/
    Route::match(['get','post'],'/cms/add','CmsController@addCmsPage')->name('admin.addCmsPage');

    /*======================View CMS Route (admin)==================================*/
    Route::get('/cms/view','CmsController@viewCmsPage')->name('admin.viewCmsPages');

    /*======================Delete CMS Route (admin)==================================*/
    Route::get('/cms/delete/{id}','CmsController@deleteCmsPage')->name('admin.deleteCmsPage');

    /*======================Update CMS Route (admin)==================================*/
    Route::match(['get','post'],'/cms/update/{id}','CmsController@updateCmsPage')->name('admin.editCms');

    /*======================About CMS Route (admin)==================================*/
    Route::match(['get', 'post'],'/page/{url}', 'CmsController@cmsPage')->name('page');


    /*-----------------------------------------ORDERS ROUTE BEGINGS----------------------------------------*/
    Route::match(['get','post'],'/orders/view','ProductsController@viewOrders')->name('admin.viewOrders');
//    Route::get('/orders/history/{id}','ProductsController@orderHistory')->name('admin.orderHistory');

    Route::match(['get','post'],'orders/history/{user_id}', ['uses'=>'ProductsController@orderHistory', 'as'=>'admin.orderHistory']);
//    Route::get('income/pdfview','FinancesController@pdf_income_view')->name('Orders-report.pdf');

    /*======================Admin Order Details Route (User)==================================*/
    Route::get('/view-order/{id}','ProductsController@viewOrderDetails')->name('admin.viewOrderDetails');

    /*======================Admin Update Order Status Route (User)==================================*/
    Route::post('/view-order-status','ProductsController@updateOrderStatus')->name('admin.updateOrderStatus');
    Route::get('/view-order-charts','AdminController@orderChart')->name('admin.order.chart');

    /*======================CHARTS==================================*/


});

Route::get('/user/profile',['uses'=>'ProfilesController@index', 'as'=>'user.profile']);
Route::post('/user/profile/update',['uses'=>'ProfilesController@update', 'as'=>'user.profile.update']);

/*-----------------------------------------CUSTOMERS ROUTE START----------------------------------------*/
Route::match(['get','post'],'/customers/create/step1', ['uses'=>'CustomersController@createCustomerStep1', 'as'=>'customers.create_step1']);
Route::match(['get','post'],'/customers/create/step2/{id}', ['uses'=>'CustomersController@createCustomerStep2', 'as'=>'customers.create_step2']);
Route::match(['get','post'],'/customers/create/step3/{id}', ['uses'=>'CustomersController@createCustomerStep3', 'as'=>'customers.create_step3']);

Route::match(['get','post'],'/customers/place_order', ['uses'=>'CustomersController@place_order', 'as'=>'customers.place_order']);

Route::get('/customers', ['uses'=>'CustomersController@index', 'as'=>'customers']);
Route::post('customers/add/new_item', ['uses'=>'CustomersController@addNewRow', 'as'=>'add_new_item']);
Route::post('customers/order/price', ['uses'=>'CustomersController@getPriceAndQty', 'as'=>'order.price']);
Route::post('customers/get/discount', ['uses'=>'CustomersController@getDiscount', 'as'=>'get.discount']);
Route::post('customers/order/placing', ['uses'=>'CustomersController@order_place', 'as'=>'order.place']);
//Route::post('/customers/category/store', ['uses'=>'CustomerCategoryController@store', 'as'=>'customers.category.store']);

//Route::get('/customers/category/edit/{id}', ['uses'=>'CustomerCategoryController@edit', 'as'=>'customers.category.edit']);
//
//Route::post('/customers/category/update/{id}', ['uses'=>'CustomerCategoryController@update', 'as'=>'customers.category.update']);
//
//Route::get('/customers/category/delete/{id}', ['uses'=>'CustomerCategoryController@destroy', 'as'=>'customers.category.delete']);
/*-----------------------------------------CUSTOMERS CATEGORIES ROUTE END----------------------------------------*/

/*-----------------------------------------CUSTOMERS LOCATIONS ROUTE START----------------------------------------*/
//Route::get('/customers/areas', ['uses'=>'AreasController@index', 'as'=>'areas']);
//
//Route::post('/customers/areas/store', ['uses'=>'AreasController@store', 'as'=>'areas.store']);
//
////Route::get('/customers/areas/edit/{id}', ['uses'=>'AreasController@edit', 'as'=>'areas.edit']);
//
//Route::post('/customers/areas/update/{id}', ['uses'=>'AreasController@update', 'as'=>'areas.update']);
//
//Route::get('/customers/areas/delete/{id}', ['uses'=>'AreasController@destroy', 'as'=>'areas.delete']);
/*-----------------------------------------CUSTOMERS LOCATIONS ROUTE END----------------------------------------*/

/*-----------------------------------------CUSTOMERS ROUTE START----------------------------------------*/
//Route::get('/customers', ['uses'=>'CustomersController@index', 'as'=>'customers']);

//Route::get('/customers/categories', ['uses'=>'CustomersController@categories', 'as'=>'customers.categories']);

//Route::get('/customer/create', ['uses'=>'CustomersController@create', 'as'=>'customer.create']);
//
//Route::post('/customer/store', ['uses'=>'CustomersController@store', 'as'=>'customer.store']);
//
//Route::get('/customer/edit/{id}', ['uses'=>'CustomersController@edit', 'as'=>'customer.edit']);
//
//Route::post('/customer/update/{id}', ['uses'=>'CustomersController@update', 'as'=>'customer.update']);
//
//Route::get('/customer/delete/{id}', ['uses'=>'CustomersController@delete', 'as'=>'customer.delete']);
//
//Route::get('/customers/deactivated', ['uses'=>'CustomersController@trashes', 'as'=>'customers.trashes']);
//
//Route::get('/customer/deactivate/{id}', ['uses'=>'CustomersController@destroy', 'as'=>'customer.deactivate']);
//
//Route::get('/customer/restore/{id}', ['uses'=>'CustomersController@restore', 'as'=>'customer.restore']);
//
//Route::post('/customer/profile/update/{id}',['uses'=>'CustomersController@update', 'as'=>'customer.profile.update']);
//
//Route::get('/customers/locations', ['uses'=>'CustomersController@locations', 'as'=>'customers.locations']);
//
//Route::resource('customer/area', 'CustomerAreasController');

/*-----------------------------------------CUSTOMERS ROUTE END----------------------------------------*/

/*-----------------------------------------FUNCTIONS START----------------------------------------*/
Route::get('/admin/delete-product-image/{id}','CasesController@deleteProductImage')->name('admin.deleteProductImage');
Route::get('order/invoice', ['uses'=>'OrdersController@invoice', 'as'=>'order.invoice']);

/*-----------------------------------------FUNCTIONS END----------------------------------------*/
Route::get('/pdf', 'PdfController@generate')->name('gen.pdf');
