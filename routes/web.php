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

Route::group(['middleware' => ['web'], 'namespace' => 'Admin'], function () {
    // route to show the login form
    Route::get('login', array('uses' => 'HomeController@showLogin'))->name('show_login');
    Route::get('refreshCaptcha', array('uses' => 'HomeController@refreshCaptcha'))->name('refresh_captcha');

// route to process the form
    Route::post('login', array('uses' => 'HomeController@doLogin'))->name('do_login');
});

Route::group(['middleware' => ['web', 'admin'], 'namespace' => 'Admin'], function () {
    Route::get('/', 'HomeController@index')->name('homepage');
    Route::get('/logout', 'HomeController@logout')->name('logout');
});

Route::group(['middleware' => ['web', 'admin'], 'namespace' => 'Admin', 'prefix' => 'wax'], function () {
    Route::get('/', 'WaxController@index')->name('wax_labour_list');
    Route::get('labour-new-entry', 'WaxController@newLabour')->name('labour_new_entry');
    Route::post('labour-new-entry', 'WaxController@createLabour')->name('labour_new_entry');
    Route::get('labour-edit-entry/{entry_id}', 'WaxController@editLabour')->name('labour_edit_entry');
    Route::post('labour-edit-entry/{entry_id}', 'WaxController@updateLabour')->name('labour_edit_entry');
    Route::delete('labour-delete-entry/{entry_id}', 'WaxController@deleteLabour')->name('labour_delete_entry');
    
    Route::get('labour-work/{labour_id}', 'WaxController@labourWork')->name('wax_work_list');
    Route::get('wax-work-new-entry/{labour_id}', 'WaxController@newWorkEntry')->name('wax_work_new_entry');
    Route::post('wax-work-new-entry/{labour_id}', 'WaxController@createWorkEntry')->name('wax_work_create_entry');
    Route::get('wax-work-complete-entry/{entry_id}', 'WaxController@showComplete')->name('wax_work_complete_entry');
    Route::post('wax-work-complete-entry/{entry_id}', 'WaxController@doComplete')->name('wax_work_complete_entry');
    Route::get('wax-work-edit-entry/{entry_id}', 'WaxController@editEntry')->name('wax_work_edit_entry');
    Route::post('wax-work-edit-entry/{entry_id}', 'WaxController@updateEntry')->name('wax_work_edit_entry');
    Route::delete('wax-work-delete-entry/{entry_id}', 'WaxController@deleteEntry')->name('wax_work_delete_entry');
    Route::get('do-archieve/{labour_id}', 'WaxController@archieveEntry')->name('wax_do_archieve');
//    Route::get('invoice-handle-withdrawal/{labour_id}', 'WaxController@handleWithdrawal')->name('wax_invoice_handle_withdrawal');
    Route::post('do-archieve/{labour_id}', 'WaxController@handleArchieveEntry')->name('wax_do_archieve');
    Route::get('list-archieve-batch/{labour_id}', 'WaxController@listArchieveBatch')->name('list_archieve_batch');
    Route::get('fetch-archieve-entry/{batch_id}', 'WaxController@fetchArchieveEntry')->name('wax_fetch_archieve_entry');
    
    Route::get('wax-given-weight-list/{labour_id}', 'WaxController@listWaxGiven')->name('wax_given_weight_list');    
    Route::get('wax-given-new-entry/{labour_id}', 'WaxController@newWaxGiven')->name('wax_given_new_entry');    
    Route::post('wax-given-new-entry/{labour_id}', 'WaxController@createWaxGiven')->name('wax_given_new_entry');    
    
    Route::get('wax-design-list', 'WaxController@listWaxDesign')->name('wax-design-list');    
    Route::get('wax-design-new-entry', 'WaxController@newWaxDeign')->name('wax_design_new_entry');
    Route::post('wax-design-new-entry', 'WaxController@createWaxDesign')->name('wax_design_new_entry');
    Route::get('wax-design-edit-entry/{entry_id}', 'WaxController@editDesign')->name('wax_design_edit_entry');
    Route::post('wax-design-edit-entry/{entry_id}', 'WaxController@updateDesign')->name('wax_design_edit_entry');
    Route::delete('wax-design-delete-entry/{entry_id}', 'WaxController@deleteDesign')->name('wax_design_delete_entry');
    
    Route::get('wax_withdrawal_list/{labour_id}', 'WaxController@listWithdrawal')->name('wax_withdrawal_list');    
    Route::get('wax_withdrawal_new_entry/{labour_id}', 'WaxController@newWithdrawal')->name('wax_withdrawal_new_entry');    
    Route::post('wax_withdrawal_new_entry/{labour_id}', 'WaxController@createWithdrawal')->name('wax_withdrawal_new_entry');    
    
    Route::get('order-form-list/{labour_id}', 'WaxController@listOrderForm')->name('wax_order_form_list');    
    Route::get('new-order_form/{labour_id}', 'WaxController@newOrderForm')->name('wax_new_order_form');    
    Route::post('new-order_form/{labour_id}', 'WaxController@createOrderForm')->name('wax_new_order_form');    
    
});

Route::group(['middleware' => ['web', 'admin'], 'namespace' => 'Admin', 'prefix' => 'casting'], function () {
    Route::get('/', 'CastingController@index')->name('casting_labour_list');
    Route::get('labour-work/{id}', 'CastingController@labourWork')->name('casting_work_list');
});

Route::group(['middleware' => ['web', 'admin'], 'namespace' => 'Admin', 'prefix' => 'nachak'], function () {
    Route::get('/', 'NachakController@index')->name('nachak_labour_list');
    Route::get('labour-work/{id}', 'NachakController@labourWork')->name('nachak_work_list');
});

Route::group(['middleware' => ['web', 'admin'], 'namespace' => 'Admin', 'prefix' => 'jaboro'], function () {
    Route::get('/', 'JaboroController@index')->name('jaboro_labour_list');
    Route::get('labour-work/{id}', 'JaboroController@labourWork')->name('jaboro_work_list');
});

Route::group(['middleware' => ['web', 'admin'], 'namespace' => 'Admin', 'prefix' => 'drum'], function () {
    Route::get('/', 'DrumController@index')->name('drum_labour_list');
    Route::get('labour-work/{id}', 'DrumController@labourWork')->name('drum_work_list');
});

Route::group(['middleware' => ['web', 'admin'], 'namespace' => 'Admin', 'prefix' => 'rev'], function () {
    Route::get('/', 'RevController@index')->name('rev_labour_list');
    Route::get('labour-work/{id}', 'RevController@labourWork')->name('rev_work_list');
});

Route::group(['middleware' => ['web', 'admin'], 'namespace' => 'Admin', 'prefix' => 'dull'], function () {
    Route::get('/', 'DullController@index')->name('dull_labour_list');
    Route::get('labour-work/{id}', 'DullController@labourWork')->name('dull_work_list');
});

Route::group(['middleware' => ['web', 'admin'], 'namespace' => 'Admin', 'prefix' => 'chholkam'], function () {
    Route::get('/', 'ChholkamController@index')->name('chholkam_labour_list');
    Route::get('labour-work/{id}', 'ChholkamController@labourWork')->name('chholkam_work_list');
});

Route::group(['middleware' => ['web', 'admin'], 'namespace' => 'Admin', 'prefix' => 'gold'], function () {
    Route::get('/', 'GoldController@index')->name('gold_labour_list');
    Route::get('labour-work/{id}', 'GoldController@labourWork')->name('gold_work_list');
});

Route::group(['middleware' => ['web', 'admin'], 'namespace' => 'Admin', 'prefix' => 'dimond'], function () {
    Route::get('/', 'DimondController@index')->name('dimond_labour_list');
    Route::get('labour-work/{id}', 'DimondController@labourWork')->name('dimond_work_list');
});

Route::group(['middleware' => ['web', 'admin'], 'namespace' => 'Admin', 'prefix' => 'mino'], function () {
    Route::get('/', 'MinoController@index')->name('mino_labour_list');
    Route::get('labour-work/{id}', 'MinoController@labourWork')->name('mino_work_list');
});

Route::group(['middleware' => ['web', 'admin'], 'namespace' => 'Admin', 'prefix' => 'packing'], function () {
    Route::get('/', 'PackingController@index')->name('packing_labour_list');
    Route::get('labour-work/{id}', 'PackingController@labourWork')->name('packing_work_list');
});

Route::any('captcha-test', function() {
    if (Request::getMethod() == 'POST') {
        $rules = ['captcha' => 'required|captcha'];
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            echo '<p style="color: #ff0000;">Incorrect!</p>';
        } else {
            echo '<p style="color: #00ff30;">Matched :)</p>';
        }
    }

    $form = '<form method="post" action="captcha-test">';
    $form .= '<input type="hidden" name="_token" value="' . csrf_token() . '">';
    $form .= '<p>' . captcha_img() . '</p>';
    $form .= '<p><input type="text" name="captcha"></p>';
    $form .= '<p><button type="submit" name="check">Check</button></p>';
    $form .= '</form>';
    return $form;
});
