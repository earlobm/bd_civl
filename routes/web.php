<?php

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
Route::group(['middleware'=>['guest']],function(){
    Route::get('/','Auth\LoginController@showLoginForm');
    Route::post('/login', 'Auth\LoginController@login')->name('login');
    Route::post('/restablecer', 'UsuarioController@restablecer')->name('restablecer');
});

Route::group(['middleware'=>['auth']],function(){

 

Route::get('/logout', 'Auth\LoginController@logout');
/*Route::get('/', function () {
    return view('welcome');
});*/

// Route::get('/', function () {
//     return view('contenido');
// });
Route::get('/main', function () {
    return view('contenido');
})->name('main');

//Customer Pledge
Route::get('/getListCustomer', 'Register\CustomerPledgeController@list_customer');
Route::get('/edit_data', 'Register\CustomerPledgeController@getDatabyNroDoc'); 
Route::get('/get_department', 'Register\CustomerPledgeController@list_department'); 
Route::get('/get_province', 'Register\CustomerPledgeController@list_province');
Route::get('/get_district', 'Register\CustomerPledgeController@list_district'); 
Route::get('/get_type_document', 'Register\CustomerPledgeController@list_type_document'); 
Route::post('/save_customer', 'Register\CustomerPledgeController@save'); 
Route::post('/delete_customer', 'Register\CustomerPledgeController@delete'); 
//Customer Credit
Route::post('/deleteCustomerCredit', 'Register\CustomerCreditController@delete'); 
Route::get('/getListCustomerCredit', 'Register\CustomerCreditController@list_customer');  
Route::get('/get_type_requeriment', 'Register\CustomerCreditController@list_type_requerement');
Route::get('/get_type_business', 'Register\CustomerCreditController@list_type_business');
Route::get('/get_job', 'Register\CustomerCreditController@list_job');
Route::post('/saveCustomerCredit', 'Register\CustomerCreditController@save_data'); 
Route::get('/generate_code', 'Register\CustomerCreditController@generate_code');  
//DOCUMENT
Route::post('/save_Document', 'Register\DocumentCustomerController@save_Document'); 
Route::get('/getlistDocument', 'Register\DocumentCustomerController@getlistDocument');
Route::get('/getEditListDocument', 'Register\DocumentCustomerController@getEditListDocument');
Route::post('/delete_Document', 'Register\DocumentCustomerController@delete_Document'); 

//Business
Route::post('/save_business', 'Register\TypeBusinessController@saveBusiness'); 
Route::get('/getlistBusiness', 'Register\TypeBusinessController@getlistBusiness');
Route::get('/getEditListbusiness', 'Register\TypeBusinessController@getEditListBusiness');
Route::post('/deleteBusiness', 'Register\TypeBusinessController@deleteBusiness'); 

//personal
Route::get('/getDatabyNroDocP', 'Register\PersonalController@getDatabyNroDocP'); 
Route::post('/saveEmployee', 'Register\EmployeeController@saveEmployee');
Route::get('/getListaEmpleadoList', 'Register\EmployeeController@getListaEmpleadoList');
//credit
Route::get('/getListDailyCollection', 'Movement\DailyCollectionController@getListDailyCollection'); 

//resumenDay
Route::get('/getListaResumenDay', 'Register\AmountDayController@getListaResumenDay');
Route::get('/getResumenDayFecha', 'Register\AmountDayController@getResumenDayFecha');

Route::get('/geEdittListaEmpleadoList', 'Register\EmployeeController@geEdittListaEmpleadoList');
Route::post('/delete_PersonalEmploye', 'Register\EmployeeController@delete_PersonalEmploye'); 
//Market
Route::post('/save_personal', 'Register\PersonalController@save'); 
Route::post('/save_market', 'Register\MarketController@save'); 
Route::get('/get_list_market', 'Register\MarketController@list'); 
Route::get('/editMercado', 'Register\MarketController@editMercado'); 
Route::post('/deleteMercado', 'Register\MarketController@deleteMercado'); 

//pledge
Route::post('/save_pledge', 'Register\PledgeController@save'); 
Route::post('/delete_pledge', 'Register\PledgeController@delete'); 
Route::get('/get_list_active_pledge', 'Register\PledgeController@getListActive'); 
Route::get('/dowloadContract','Register\PledgeController@dowloadContract');
Route::get('/getSuggestedPrice','Register\PledgeController@send_to_sales');
Route::get('/getProductSales','Register\PledgeController@product_sales');
Route::post('/save_suggested_price','Register\PledgeController@save_suggested_price');
Route::post('/save_final_price','Register\PledgeController@save_final_price');
//payment
Route::get('/get_detail_movement_pledge', 'Register\PledgeController@get_detail_movement_pledge'); 
Route::get('/get_movement_pledge', 'Register\PledgeController@get_movement_pledge'); 
Route::get('/get_list_on_sale','Register\PledgeController@list_on_sale');
Route::get('/get_list_pawned','Register\PledgeController@list_pawned');
Route::get('/get_list_defeated','Register\PledgeController@list_defeated');
Route::get('/get_list_data','Register\PledgeController@list_data');

//guardando pagos de empeño
Route::post('/save_payment_pledge','Movement\PaymentPledgeController@save');
Route::get('/ticket_plegde','Movement\PaymentPledgeController@ticket_plegde');

//garmentType
Route::get('/getDependenceParent', 'Register\DependenceController@getDependenceParent');
Route::post('/saveDependence', 'Register\DependenceController@saveDependence');
Route::post('/delete_typeProduct', 'Register\DependenceController@delete_typeProduct');
Route::get('/getEditDependenceTypeProduct', 'Register\DependenceController@getEditDependenceTypeProduct'); 
Route::post('/saveDependenceFamily', 'Register\DependenceController@saveDependenceFamily');
Route::post('/delete_FamilyProduct', 'Register\DependenceController@delete_FamilyProduct');
Route::get('/getEditDependenceFamilyProduct', 'Register\DependenceController@getEditDependenceFamilyProduct');
//BranchOffice
Route::post('/save_branch_office','Register\BranchOfficeController@save'); 
Route::get('/get_branch_office', 'Register\BranchOfficeController@edit'); 
Route::get('/get_combo_branch_office', 'Register\BranchOfficeController@combo_list'); 
Route::get('/get_combo_market', 'Register\MarketController@combo_list'); 
Route::get('/get_list_branch_office', 'Register\BranchOfficeController@list'); 
Route::post('/delete_branch_office', 'Register\BranchOfficeController@delete'); 

//dependencia
//Route::get('/getDependencyParent', 'Register\DependencyController@getDependencyParent');
Route::get('/getDependencyList', 'Register\DependenceController@getDependencyList');
Route::post('/saveDependencyParent', 'Register\DependenceController@saveDependency'); 
Route::get('/getEditDependency', 'Register\DependenceController@getEditDependency');
Route::post('/delete_dependency', 'Register\DependenceController@delete_dependency');
//Reference
Route::post('/saveReference', 'Register\ReferenceController@saveReference');
Route::get('/getListReference', 'Register\ReferenceController@getListReference');
Route::post('/delete_Reference', 'Register\ReferenceController@delete_Reference');
Route::get('/getEditReference', 'Register\ReferenceController@getEditReference');
//Route::post('/save_customer', 'Register\CustomerPledgeController@save'); 
//Route::get('/getListIncome', 'Register\Box\IncomeController@getListIncome'); 
//Route::post('/delete_Income', 'Register\Box\IncomeController@delete_Income'); 
//Route::get('/getEditIncome', 'Register\Box\IncomeController@getEditIncome'); 
//Income
Route::post('/saveIncome', 'Register\Box\IncomeController@saveIncome');
Route::get('/getListIncome', 'Register\Box\IncomeController@getListIncome'); 
Route::post('/delete_Income', 'Register\Box\IncomeController@delete_Income'); 
Route::get('/getEditIncome', 'Register\Box\IncomeController@getEditIncome');


//IncomeType
Route::post('/saveIncomeType', 'Register\Box\IncomeTypeController@saveIncomeType');
Route::get('/getListIncomeType', 'Register\Box\IncomeTypeController@getListIncomeType'); 
Route::post('/delete_IncomeType', 'Register\Box\IncomeTypeController@delete_IncomeType'); 
Route::get('/getEditIncomeType', 'Register\Box\IncomeTypeController@getEditIncomeType');
Route::get('/comboTypeIncome_list', 'Register\Box\IncomeTypeController@comboTypeIncome_list'); 
//Egress
Route::post('/saveEgress', 'Register\Box\EgressController@saveEgress');
Route::get('/getListEgress', 'Register\Box\EgressController@getListEgress'); 
Route::post('/delete_Egress', 'Register\Box\EgressController@delete_Egress'); 
Route::get('/getEditEgress', 'Register\Box\EgressController@getEditEgress');
//EgressType
Route::post('/saveEgressType', 'Register\Box\EgressTypeController@saveEgressType');
Route::get('/getListEgressType', 'Register\Box\EgressTypeController@getListEgressType'); 
Route::post('/delete_EgressType', 'Register\Box\EgressTypeController@delete_EgressType'); 
Route::get('/getEditEgressType', 'Register\Box\EgressTypeController@getEditEgressType');
Route::get('/comboTypeEgress_list', 'Register\Box\EgressTypeController@comboTypeEgress_list');
//almacen warehouse
Route::get('/getWarehouse', 'Register\WarehouseController@get');
//MontoDay
Route::get('/getMercado', 'Register\AmountDayController@getMercado');
Route::get('/getEmpleado', 'Register\AmountDayController@getEmpleado');
Route::get('/getlistSucursal', 'Register\AmountDayController@getlistSucursal');
Route::get('/getListaEmpleado', 'Register\AmountDayController@getListaEmpleado');
Route::get('/getListaEmpleadoRecibido', 'Register\AmountDayController@getListaEmpleadoRecibido');
Route::get('/getEditListAmountDayRecibido', 'Register\AmountDayController@getEditListAmountDayRecibido');
Route::get('/getEditListAmountDay', 'Register\AmountDayController@getEditListAmountDay');
Route::post('/save_Amount', 'Register\AmountDayController@save_Amount');
Route::post('/delete_AmountDay', 'Register\AmountDayController@delete_AmountDay');
Route::get('/getDataCustomerBynro_doc', 'Register\AmountDayController@getDatabyNroDoc');
//Security
Route::post('saveRole', 'Security\RoleController@saveRole'); 
Route::get('getListRol', 'Security\RoleController@getListRol');
Route::get('getEditRol', 'Security\RoleController@getEditRol');
Route::get('comboRole_list', 'Security\UserController@comboRole_list');
Route::get('getListPermission', 'Security\PermissionController@getListPermission');
Route::post('saveUser', 'Security\UserController@saveUser'); 
Route::get('getListUser', 'Security\UserController@getListUser');
Route::get('getEditUser', 'Security\UserController@getEditUser');
Route::post('delete_User', 'Security\UserController@delete_User');
//Route::get('getDataDNI', 'Security\UserController@getDataDNI');  
});
