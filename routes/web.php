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

Route::get('/home', function () {
  $response = Telegram::getMe();
  $botId = $response->getId();
  $firstName = $response->getFirstName();
  $username = $response->getUsername();
    return view('home', ['response' => $response, 'botName' => $firstName]);
});

Route::get('/sethook', function () {
  $response = Telegram::setWebhook(['url' => 'http://lartel.herokuapp.com/<token>/webhook']);
});

Route::post('/<token>/webhook', function () {
    $updates = Telegram::getWebhookUpdates();

    return 'ok';
});
