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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/json/{id?}', 'HomeController@json')->name('json');


// System
Route::group(['prefix' => 'system', 'middleware' => 'system'], function () {

    // Dashboard system_send
    Route::group(['prefix' => '/system_send'], function () {
        Route::get('', 'System\SystemSendController@index')->name('system_send.index');
        Route::post('/post_data', 'System\SystemSendController@post_data')->name('system_send.post_data');
    });


    // Dashboard call_stats
    Route::group(['prefix' => '/call_stats'], function () {
        Route::get('', 'System\CallStatsController@index')->name('call_stats.index');
        Route::get('/add_edit/{id?}', 'System\CallStatsController@add_edit')->name('call_stats.add_edit');
        Route::get('/deleted', 'System\CallStatsController@deleted')->name('call_stats.deleted');
        Route::get('/get_data_by_id', 'System\CallStatsController@get_data_by_id')->name('call_stats.get_data_by_id');
        Route::post('/post_data', 'System\CallStatsController@post_data')->name('call_stats.post_data');
        Route::post('/get_data', 'System\CallStatsController@get_data')->name('call_stats.get_data');
    });

    // Dashboard campaign
    Route::group(['prefix' => '/campaign'], function () {
        Route::get('', 'System\CampaignController@index')->name('campaign.index');
        Route::get('/add_edit/{id?}', 'System\CampaignController@add_edit')->name('campaign.add_edit');
        Route::get('/deleted', 'System\CampaignController@deleted')->name('campaign.deleted');
        Route::get('/get_data_by_id', 'System\CampaignController@get_data_by_id')->name('campaign.get_data_by_id');
        Route::post('/post_data', 'System\CampaignController@post_data')->name('campaign.post_data');
        Route::post('/get_data', 'System\CampaignController@get_data')->name('campaign.get_data');
    });


    // Dashboard query_type
    Route::group(['prefix' => '/query_type'], function () {
        Route::get('', 'System\QuerytypeController@index')->name('query_type.index');
        Route::get('/add_edit/{id?}', 'System\QuerytypeController@add_edit')->name('query_type.add_edit');
        Route::get('/deleted', 'System\QuerytypeController@deleted')->name('query_type.deleted');
        Route::get('/get_data_by_id', 'System\QuerytypeController@get_data_by_id')->name('query_type.get_data_by_id');
        Route::post('/post_data', 'System\QuerytypeController@post_data')->name('query_type.post_data');
        Route::post('/get_data', 'System\QuerytypeController@get_data')->name('query_type.get_data');
    });



});
