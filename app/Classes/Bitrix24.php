<?php

namespace App\Classes;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\ResponseInterface;

class Bitrix24
{
    /**
     * @var string
     */
    protected $webHookUrl;

    /**
     * @var Client
     */
    protected $client;

    public function __construct()
    {
        $this->webHookUrl = config('bitrix24.webhook');

        $this->client = new Client();
    }

    /**
     * Sends request to Bitrix24 API
     *
     * @param string $function - API function
     * @param array  $data     - Request body
     *
     * @return ResponseInterface
     */
    public function call(string $function, array $data)
    {
        return $this->client->request('POST', $this->getFunctionUrl($function), [
            'form_params' => $data,
        ]);
    }

    /**
     * Prepends output webhook to API function
     *
     * @param string $function - API function
     *
     * @return string - full API URL
     */
    protected function getFunctionUrl(string $function)
    {
        return "{$this->webHookUrl}{$function}";
    }
}
