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

Route::middleware(['auth'])->group(function () {

    Route::get('/users', 'UserController@index');
    Route::get('/conversations', 'ConversationController@index');
    Route::post('/conversations', 'ConversationController@createConversation');
    Route::get('/chat/{conversation_id}', 'ChatController@index');
    Route::get('/conversations/{conversation_id}', 'ChatController@fetchMessages');
    Route::post('/messages', 'ChatController@sendMessage');
});


Auth::routes();

Route::get('/home', 'HomeController@index');