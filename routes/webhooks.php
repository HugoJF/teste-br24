<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Webhooks Routes
|--------------------------------------------------------------------------
|
*/

Route::get('ONCRMDEALUPDATE', 'WebhooksController@dealUpdate')->name('webhooks.deal-update');
