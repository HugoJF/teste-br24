<?php

namespace App\Observers;

use App\Classes\Bitrix24;
use App\Company;
use Exception;

class CompanyObserver
{
    /**
     * @var Bitrix24
     */
    protected $bitrix24;

    /**
     * @var string
     */
    protected $cnpjKey;

    public function __construct(Bitrix24 $bitrix24)
    {
        $this->bitrix24 = $bitrix24;

        $this->cnpjKey = config('bitrix24.cnpjKey');
    }

    /**
     * Handle the company "creating" event.
     *
     * @param Company $company
     *
     * @return void
     * @throws Exception
     */
    public function creating(Company $company)
    {
        $response = $this->bitrix24->call('crm.company.add', [
            'fields' => [
                'TITLE'        => $company->name,
                $this->cnpjKey => $company->cnpjFormatted,
            ],
        ]);

        $body = json_decode((string) $response->getBody(), true);
        $company->bitrix_id = $body['result'];
    }

    /**
     * Handle the company "updating" event.
     *
     * @param Company $company
     *
     * @return void
     */
    public function updating(Company $company)
    {
        $response = $this->bitrix24->call('crm.company.update', [
            'id'     => $company->bitrix_id,
            'fields' => [
                'TITLE'        => $company->name,
                $this->cnpjKey => $company->cnpjFormatted,
            ]]);
    }
}
