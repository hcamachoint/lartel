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
    $response = Telegram::getMe();
    $botId = $response->getId();
    $firstName = $response->getFirstName();
    $username = $response->getUsername();
    return view('welcome', ['response' => $response, 'username' => $username, 'botId' => $botId]);
});

Route::get('/sethook', function () {
  $response = Telegram::setWebhook(['url' => 'https://lartel.herokuapp.com/<token>/webhook']);
  return $response;
});

Route::get('/unsethook', function () {
  $response = Telegram::removeWebhook();
  return $response;
});

Route::post('/<token>/webhook', function () {
    $update = Telegram::commandsHandler(true);

	// Commands handler method returns an Update object.
	// So you can further process $update object
	// to however you want.

    return 'ok';
});

/*
Route::post('/<token>/webhook', function () {
    $updates = Telegram::getWebhookUpdates();

    return 'ok';
});
*/
