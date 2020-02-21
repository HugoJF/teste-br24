<?php

namespace App\Services;

use App\Classes\Bitrix24;

class WebhookService
{
    /**
     * @var Bitrix24
     */
    protected $bitrix;

    protected $totalKey;

    public function __construct(Bitrix24 $bitrix)
    {
        $this->bitrix = $bitrix;

        $this->totalKey = config('bitrix24.company_total_key');
    }

    /**
     * Handles Deal Updates.
     *
     * Updates associated Company total value won from Deals.
     *
     * @param array $input
     *
     * @return bool
     */
    public function handleDealUpdate(array $input)
    {
        // Fetch Deal
        $dealId = data_get($input, 'data.FIELDS.ID');
        $deal = $this->getDeal($dealId);

        // Check if Deal is finished
        if ($deal['STAGE_ID'] !== 'WON') {
            return false;
        }

        // Check if Deal has a Company associated with it
        $companyId = $deal['COMPANY_ID'];
        if (!$companyId) {
            return false;
        }

        // Fetch Company
        $company = $this->getCompany($companyId);

        $total = $company[ $this->totalKey ];
        $dealOpportunity = $deal['OPPORTUNITY'];

        // Updates Company total Deals value
        $this->updateCompany($companyId, [
            $this->totalKey => floatval($total) + floatval($dealOpportunity),
        ]);

        return true;
    }

    /**
     * Get Company from Bitrix API
     *
     * @param $id - Company ID
     *
     * @return mixed
     */
    protected function getCompany($id)
    {
        return $this->getEntity('crm.company.get', $id);
    }

    /**
     * Get Deal from Bitrix API
     *
     * @param $id - Deal ID
     *
     * @return mixed
     */
    protected function getDeal($id)
    {
        return $this->getEntity('crm.deal.get', $id);
    }

    /**
     * Get entity from Bitrix API
     *
     * @param $function - Entity GET function
     * @param $id - Entity ID
     *
     * @return mixed
     */
    protected function getEntity($function, $id)
    {
        $response = $this->bitrix->call($function, compact('id'));

        $body = json_decode((string) $response->getBody(), true);

        return $body['result'];
    }

    /**
     * Updates Company fields on Bitrix
     *
     * @param $id - Company ID
     * @param $data - fields to update
     */
    protected function updateCompany($id, $data)
    {
        $this->bitrix->call('crm.company.update', [
            'id'     => $id,
            'fields' => $data,
        ]);
    }
}
