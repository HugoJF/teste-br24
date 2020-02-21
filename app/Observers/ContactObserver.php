<?php

namespace App\Observers;

use App\Classes\Bitrix24;
use App\Contact;

class ContactObserver
{
    /**
     * @var Bitrix24
     */
    protected $bitrix24;

    /**
     * @var string
     */
    protected $cpfKey;

    public function __construct(Bitrix24 $bitrix24)
    {
        $this->bitrix24 = $bitrix24;
        $this->cpfKey = config('bitrix24.cpfKey');
    }

    /**
     * Handle the contact "creating" event.
     *
     * @param Contact $contact
     *
     * @return void
     */
    public function creating(Contact $contact)
    {
        $response = $this->bitrix24->call('crm.contact.add', [
            'fields' => [
                'NAME'        => $contact->name,
                'LAST_NAME'   => $contact->surname,
                $this->cpfKey => $contact->cpfFormatted,
                'EMAIL'       => [
                    'n0' => [
                        'VALUE'      => $contact->email,
                        'VALUE_TYPE' => 'WORK',
                    ],
                ],
            ],
        ]);

        $body = json_decode((string) $response->getBody(), true);
        $contact->bitrix_id = $body['result'];
    }

    /**
     * Handle the contact "updating" event.
     *
     * @param Contact $contact
     *
     * @return void
     */
    public function updating(Contact $contact)
    {
        $this->bitrix24->call('crm.contact.update', [
            'fields' => [
                'NAME'      => $contact->name,
                'LAST_NAME' => $contact->surname,
                $this->cpfKey => $contact->cpfFormatted,
                'EMAIL'     => [
                    'n0' => [
                        'VALUE'      => $contact->email,
                        'VALUE_TYPE' => 'WORK',
                    ],
                ],
            ],
        ]);
    }
}
