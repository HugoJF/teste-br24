<?php

namespace App\Http\Controllers;

use App\Company;
use App\Http\Requests\RegisterRequest;
use App\Services\RegisterService;

class RegisterController extends Controller
{
    public function create()
    {
        flash()->success('Contato e Companhia registrados!');

        $companies = Company::with('contacts')->get();

        return view('form', compact('companies'));
    }

    public function store(RegisterRequest $request, RegisterService $service)
    {
        $service->handle($request->companyInput(), $request->contactInput());

        flash()->success('Contato e Companhia registrados!');

        return redirect()->route('index');
    }
}
