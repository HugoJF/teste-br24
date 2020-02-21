<?php

namespace App\Services;

use App\Company;

class CompanyService
{
    /**
     * Retrieves existing Company or create a new one
     *
     * @param array $input - Form input
     *
     * @return Company
     */
    public function firstOrUpdate(array $input)
    {
        $cnpj = preg_replace('/\D/', '', $input['cnpj']);
        $company = Company::query()->where('cnpj', $cnpj)->first();

        if (!$company) {
            $company = new Company();
        }

        $company->fill($input);
        $company->save();

        return $company;
    }
}
