<?php

namespace App\Services;

use App\Classes\Bitrix24;
use App\Company;
use App\Contact;

class ContactService
{
    /**
     * Retrieves existing Contact or create a new one
     *
     * @param array $input - Form input
     *
     * @return Contact
     */
    public function firstOrUpdate(array $input)
    {
        $cpf = preg_replace('/\D/', '', $input['cpf']);
        $contact = Contact::query()->where('cpf', $cpf)->first();

        if (!$contact) {
            $contact = new Contact();
        }

        $contact->fill($input);
        $contact->save();

        return $contact;
    }

    /**
     * Adds Company to Contact on Bitrix24 API
     *
     * @param Contact $contact
     * @param Company $company
     */
    public function attach(Contact $contact, Company $company)
    {
        /** @var Bitrix24 $bitrix24 */
        $bitrix24 = app(Bitrix24::class);

        $bitrix24->call('crm.contact.company.add', [
            'id'     => $contact->bitrix_id,
            'fields' => [
                'COMPANY_ID' => $company->bitrix_id,
            ],
        ]);
    }
}
