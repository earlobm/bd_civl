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
   // Route::post('/restablecer', 'UsuarioController@restablecer')->name('restablecer');
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

//Customer Credit
Route::get('/get_department', 'Register\CustomerCreditController@list_department'); 
Route::get('/get_province', 'Register\CustomerCreditController@list_province');
Route::get('/get_district', 'Register\CustomerCreditController@list_district'); 
//madre
Route::get('/get_department_madre', 'Register\NacidoController@get_department_madre'); 
Route::get('/get_province_madre', 'Register\NacidoController@get_province_madre');
Route::get('/get_district_madre', 'Register\NacidoController@get_district_madre');
//padre
Route::get('/get_department_padre', 'Register\NacidoController@get_department_padre'); 
Route::get('/get_province_padre', 'Register\NacidoController@get_province_padre');
Route::get('/get_district_padre', 'Register\NacidoController@get_district_padre');

Route::get('/get_type_document', 'Register\CustomerCreditController@list_type_document'); 
Route::post('/deleteCustomerCredit', 'Register\CustomerCreditController@delete'); 
 
//Route::get('/get_type_requirement', 'Register\CustomerCreditController@list_type_requerement');
//Route::get('/get_type_business', 'Register\CustomerCreditController@list_type_business');
//Route::get('/get_job', 'Register\CustomerCreditController@list_job');
//Route::get('/get_employee', 'Register\EmployeeController@list_employee');
Route::post('/save_customer_credit', 'Register\CustomerCreditController@save_data'); 
//CIUDADANO
Route::post('/saveCiudadano', 'Register\CustomerCreditController@saveCiudadano');
Route::get('/getListCustomerCredit', 'Register\CustomerCreditController@list_customer');  
//NACIDO
Route::post('/saveNacido', 'Register\NacidoController@saveNacido');
Route::get('/getDatabyNroDocP', 'Register\NacidoController@getDatabyNroDocP');  


Route::post('/save_detail_credit', 'Register\CustomerCreditController@save_detail_credit'); 
Route::get('/generate_code', 'Register\CustomerCreditController@generate_code');  
Route::get('/get_customer_by_dni', 'Register\CustomerCreditController@get_customer_by_dni'); 
Route::get('/get_aval_by_dni', 'Register\CustomerCreditController@get_aval_by_dni'); 
Route::get('/download_detail_credit', 'Register\CustomerCreditController@download_detail_credit'); 
//DOCUMENT
Route::post('/save_Document', 'Register\DocumentCustomerController@save_Document'); 
Route::get('/getlistDocument', 'Register\DocumentCustomerController@getlistDocument');
Route::get('/getEditListDocument', 'Register\DocumentCustomerController@getEditListDocument');
Route::post('/delete_Document', 'Register\DocumentCustomerController@delete_Document'); 

//Business
Route::post('/save_business', 'Register\TypeBusinessController@saveBusiness'); 
Route::get('/getlistBusiness', 'Register\TypeBusinessController@getlistBusiness');
Route::get('/list_data', 'Register\TypeBusinessController@list');
Route::get('/getEditListbusiness', 'Register\TypeBusinessController@getEditListBusiness');
Route::post('/deleteBusiness', 'Register\TypeBusinessController@deleteBusiness'); 

//personal
//Route::get('/getDatabyNroDocP', 'Register\PersonalController@getDatabyNroDocP'); 
Route::post('/saveEmployee', 'Register\EmployeeController@saveEmployee');
//Route::get('/getListaEmpleadoList', 'Register\EmployeeController@list_employee');
//credit
Route::get('/getListDailyCollection', 'Operation\DailyCollectionController@getListDailyCollection'); 
Route::get('/getListDailyBalance', 'Operation\DailyBalanceController@getListDailyBalance'); 
Route::get('/downloadDayliBalance', 'Operation\DailyBalanceController@downloadPdf'); 
//histotial
Route::get('/creditByCustomer', 'Operation\CustomerHistoryController@creditByCustomer'); 


//resumenDay
Route::get('/getListaResumenDay', 'Register\AmountDayController@getListaResumenDay');
Route::get('/getResumenDayFecha', 'Register\AmountDayController@getResumenDayFecha');
Route::get('/getAmountDayFecha', 'Register\AmountDayController@getAmountDayFecha');

Route::get('/geEdittListaEmpleadoList', 'Register\EmployeeController@geEdittListaEmpleadoList');
Route::post('/delete_PersonalEmploye', 'Register\EmployeeController@delete_PersonalEmploye'); 
//Market
Route::post('/save_personal', 'Register\PersonalController@save'); 
Route::post('/save_market', 'Register\MarketController@save'); 
Route::get('/get_list_market', 'Register\MarketController@list'); 
Route::get('/edit_market', 'Register\MarketController@edit_market'); 
Route::post('/deleteMercado', 'Register\MarketController@deleteMercado'); 


//Operation Payment
Route::post('/save_payment','Operation\DailyCollectionController@save');
Route::get('/downloadDayliCollection','Operation\DailyCollectionController@downloadDayliCollection');

//guardando pagos de empeño
Route::post('/save_payment_pledge','Operation\PaymentPledgeController@save');

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
