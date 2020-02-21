<?php

namespace App\Http\Controllers;

use App\Services\WebhookService;
use Illuminate\Http\Request;

class WebhooksController extends Controller
{
    public function dealUpdate(Request $request, WebhookService $service)
    {
        $service->handleDealUpdate($request->all());
    }
}
