<?php

namespace App\Services;

class RegisterService
{
    /**
     * Handles the entire main form.
     *
     * Creates Company/Contact when they don't exist and attaches them to each other on Bitrix24.
     *
     * @param array $companyInput
     * @param array $contactInput
     */
    public function handle(array $companyInput, array $contactInput)
    {
        /** @var CompanyService $companyService */
        $companyService = app(CompanyService::class);
        /** @var ContactService $contactService */
        $contactService = app(ContactService::class);

        // Create or fetch models
        $company = $companyService->firstOrUpdate($companyInput);
        $contact = $contactService->firstOrUpdate($contactInput);

        // Check if already related to avoid SQL unique exception
        if (!$company->contacts()->where('cpf', $contact->cpf)->exists()) {
            $company->contacts()->attach($contact);
            $contactService->attach($contact, $company);
        }
    }
}
