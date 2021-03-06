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
 
//Rutas para todos los roles 
Auth::routes(); 
Route::group(['middleware'=>['auth','prevent-back-history']], function(){
	Route::view('/perfil','profile')->name('profile');
	Route::get('/perfil/editar','Admin\UserController@editProfile')->name('edit profile');
	Route::put('/perfil/update/{user}','Admin\UserController@updateProfile')->name('update profile');
	Route::get('/descripcion','HomeController@showDescription')->name('show description');
});
Route::get('/','HomeController@index')->name('root');
Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout')->name('logout');
Route::get('/home', 'HomeController@index')->name('home');
Route::post('dynamic_dependent/fetch', 'DynamicDependent@fetch')->name('ajax fetch'); // filtrado de pacientes ajax
//==================================================RUTAS DOCTOR================================================
Route::group(['middleware'=>['check.doctor.role','prevent-back-history']], function(){
	//CRUD citas
	Route::get('/d_citas', 'Doctor\AppointmentController@index')->name('doctor appointments');
	Route::get('/d_citas/agregar','Doctor\AppointmentController@create')->name('doctor create appointment');
	Route::get('/d_citas/editar/{appointment}','Doctor\AppointmentController@edit')->name('doctor edit appointment');
	Route::post('/d_citas/guardar','Doctor\AppointmentController@store')->name('doctor store appointment');
	Route::put('/d_citas/actualizar/{appointment}', 'Doctor\AppointmentController@update')->name('doctor update appointment');
	Route::delete('/d_citas/eliminar/{appointment}', 'Doctor\AppointmentController@destroy')->name('doctor destroy appointment');

	//CRUD productos
	Route::get('/d_productos','Doctor\ItemController@index')->name('doctor items');
	Route::get('/d_productos/agregar','Doctor\ItemController@create')->name('doctor create item');
	Route::get('/d_productos/editar/{item}','Doctor\ItemController@edit')->name('doctor edit item');
	Route::post('/d_productos/guardar', 'Doctor\ItemController@store')->name('doctor store item');
	Route::put('/d_productos/actualizar/{item}', 'Doctor\ItemController@update')->name('doctor update item');
	Route::delete('/d_productos/eliminar/{item}', 'Doctor\ItemController@destroy')->name('doctor destroy item');
	Route::get('/d_productos/reporte','Doctor\ItemController@showPDF')->name('doctor items pdf');
	//CRUD pacientes
	Route::get('/d_pacientes', 'Doctor\PatientController@index')->name('doctor patients');
	Route::get('/d_pacientes/editar/{patient}','Doctor\PatientController@edit')->name('doctor edit patient');
	Route::get('/d_pacientes/agregar','Doctor\PatientController@create')->name('doctor create patient');
	Route::get('/d_pacientes/apuntes/{patient}','Doctor\PatientController@show')->name('doctor patient notes');
	Route::delete('/d_pacientes/eliminar/{patient}','Doctor\PatientController@destroy')->name('doctor destroy patient');
	Route::put('/d_pacientes/actualizar/{patient}','Doctor\PatientController@update')->name('doctor update patient');
	Route::post('/d_pacientes/guardar','Doctor\PatientController@store')->name('doctor store patient');
	//CRUD procedimientos 
	Route::get('/d_procedimientos', 'Doctor\ProcedureController@index')->name('doctor procedures');
	Route::get('/d_procedimientos/editar/{patient}','Doctor\ProcedureController@edit')->name('doctor edit procedure');
	Route::get('/d_procedimientos/agregar','Doctor\ProcedureController@create')->name('doctor create procedure');
	Route::delete('/d_procedimientos/eliminar/{procedure}','Doctor\ProcedureController@destroy')->name('doctor destroy procedure');
	Route::put('/d_procedimientos/actualizar/{procedure}','Doctor\ProcedureController@update')->name('doctor update procedure');
	Route::post('/d_procedimientos/guardar','Doctor\ProcedureController@store')->name('doctor store procedure');
	//CRUD historial paciente
	Route::get('/d_pacientes/historial/{patient_id}','Doctor\PatientLogController@index')->name('doctor patient logs');
	Route::get('/d_pacientes/historial/editar/{patient_log}','Doctor\PatientLogController@edit')->name('doctor edit patient log');
	Route::get('/d_pacientes/historial/agregar','Doctor\PatientLogController@create')->name('doctor create patient log');
	Route::delete('/d_pacientes/historial/eliminar/{appointment}', 'Doctor\PatientLogController@destroy')->name('doctor destroy appointment log');

	//CRUD imegenes
	Route::get('/d_pacientes/historial/{patient_id}/imagen/{appointment_id}','Doctor\ImageController@index')->name('images');
	Route::get('/d_pacientes/historial/{patient_id}/imagen/{appointment_id}/ver/{img_id}','Doctor\ImageController@show')->name('images show');
	Route::get('/d_pacientes/historial/{patient_id}/imagen/agregar/{appointment_id}','Doctor\ImageController@create')->name('images create'); //
	Route::post('/d_pacientes/historial/{patient_id}/imagen/{appointment_id}','Doctor\ImageController@store')->name('images store');
	Route::delete('/d_pacientes/historial/{patient_id}/imagen/eliminar/{appointment_id}', 'Doctor\ImageController@destroy')->name('images destroy');

});

//==================================================RUTAS ASISTENTE================================================
Route::group(['middleware'=>['check.assistant.role','prevent-back-history']], function(){
	//CRUD citas
	Route::get('/a_citas', 'Assistant\AppointmentController@index')->name('assistant appointments');
	Route::get('/a_citas/agregar','Assistant\AppointmentController@create')->name('assistant create appointment');
	Route::get('/a_citas/editar/{appointment}','Assistant\AppointmentController@edit')->name('assistant edit appointment');
	Route::post('/a_citas/guardar','Assistant\AppointmentController@store')->name('assistant store appointment');
	Route::put('/a_citas/actualizar/{appointment}', 'Assistant\AppointmentController@update')->name('assistant update appointment');
	Route::delete('/a_citas/eliminar/{appointment}', 'Assistant\AppointmentController@destroy')->name('assistant destroy appointment');
	//CRUD pacientes
	Route::get('/a_pacientes', 'Assistant\PatientController@index')->name('assistant patients');
	Route::get('/a_pacientes/agregar','Assistant\PatientController@create')->name('assistant create patient');
	Route::get('/a_pacientes/editar/{patient}','Assistant\PatientController@edit')->name('assistant edit patient');
	Route::get('/a_pacientes/apuntes/{patient}','Assistant\PatientController@show')->name('assistant patient notes');
	Route::put('/a_pacientes/actualizar/{patient}','Assistant\PatientController@update')->name('assistant update patient');
	Route::post('/a_pacientes/guardar','Assistant\PatientController@store')->name('assistant store patient');
	Route::delete('/a_pacientes/eliminar/{patient}','Assistant\PatientController@destroy')->name('assistant destroy patient');
	//CRUD historial paciente
	Route::get('/a_pacientes/historial','Assistant\PatientLogController@index')->name('assistant patient logs');
	Route::get('/a_pacientes/historial/agregar','Assistant\PatientLogController@create')->name('assistant create patient log');
	Route::get('/a_pacientes/historial/editar/{patient_log}','Assistant\PatientLogController@edit')->name('assistant edit patient log');
	//CRUD productos
	Route::get('/a_productos', 'Assistant\ItemController@index')->name('assistant items');
	Route::get('/a_productos/editar/{item}','Assistant\ItemController@edit')->name('assistant edit item');
	Route::get('/a_productos/agregar','Assistant\ItemController@create')->name('assistant create item');
	Route::post('/a_productos/guardar','Assistant\ItemController@store')->name('assistant store item');
	Route::put('/a_productos/actualizar/{item}','Assistant\ItemController@update')->name('assistant update item');
	Route::delete('/a_productos/eliminar/{item}','Assistant\ItemController@destroy')->name('assistant destroy item');
	Route::get('/a_productos/reporte','Assistant\ItemController@showPDF')->name('assistant items pdf');
	//CRUD procedimientos 
	Route::get('/a_procedimientos', 'Assistant\ProcedureController@index')->name('assistant procedures');
	Route::get('/a_procedimientos/editar/{patient}','Assistant\ProcedureController@edit')->name('assistant edit procedure');
	Route::get('/a_procedimientos/agregar','Assistant\ProcedureController@create')->name('assistant create procedure');
	Route::delete('/a_procedimientos/eliminar/{procedure}','Assistant\ProcedureController@destroy')->name('assistant destroy procedure');
	Route::put('/a_procedimientos/actualizar/{procedure}','Assistant\ProcedureController@update')->name('assistant update procedure');
	Route::post('/a_procedimientos/guardar','Assistant\ProcedureController@store')->name('assistant store procedure');
});

//==================================================RUTAS ADMIN================================================
Route::group(['middleware'=>['check.admin.role','prevent-back-history']], function(){
	//CRUD usuarios
	Route::get('/ad_usuarios','Admin\UserController@index')->name('admin users');
	Route::resource('usuarios','Admin\UserController');
	//CRUD tipos de procedimiento
	Route::get('/ad_tipos_procedimiento','Admin\ProcedureTypeController@index')->name('admin procedure types');
	Route::get('/ad_tipos_procedimiento/agregar','Admin\ProcedureTypeController@create')->name('admin create procedure type');
	Route::get('/ad_tipos_procedimiento/editar/{procedure_type}','Admin\ProcedureTypeController@edit')->name('admin edit procedure type');
	Route::post('/ad_tipos_procedimiento/guardar', 'Admin\ProcedureTypeController@store')->name('admin store procedure type');
	Route::put('/ad_tipos_procedimiento/actualizar/{procedure_type}', 'Admin\ProcedureTypeController@update')->name('admin update procedure type');
	Route::delete('/ad_tipos_procedimiento/eliminar/{procedure_type}', 'Admin\ProcedureTypeController@destroy')->name('admin destroy procedure type');
	//CRUD marcas
	Route::get('/ad_brands','Admin\BrandController@index')->name('admin brands');
	Route::get('/ad_brands/agregar','Admin\BrandController@create')->name('admin create brand');
	Route::get('/ad_brands/editar/{brand}','Admin\BrandController@edit')->name('admin edit brand');
	Route::post('/ad_brands/guardar', 'Admin\BrandController@store')->name('admin store brand');
	Route::put('/ad_brands/actualizar/{brand}', 'Admin\BrandController@update')->name('admin update brand');
	Route::delete('/ad_brands/eliminar/{brand}', 'Admin\BrandController@destroy')->name('admin destroy brand');
	//CRUD tipos de producto
	Route::get('/ad_tipos_producto','Admin\ItemTypeController@index')->name('admin item types');
	Route::get('/ad_tipos_producto/agregar','Admin\ItemTypeController@create')->name('admin create item type');
	Route::get('/ad_tipos_producto/editar/{item_type}','Admin\ItemTypeController@edit')->name('admin edit item type');
	Route::post('/ad_tipos_producto/guardar', 'Admin\ItemTypeController@store')->name('admin store item type');
	Route::put('/ad_tipos_producto/actualizar/{item_type}', 'Admin\ItemTypeController@update')->name('admin update item type');
	Route::delete('/ad_tipos_producto/eliminar/{item_type}', 'Admin\ItemTypeController@destroy')->name('admin destroy item type');
});



