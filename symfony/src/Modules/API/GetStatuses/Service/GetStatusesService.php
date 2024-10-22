<?php

namespace App\Modules\API\GetStatuses\Service;

use App\Modules\API\GetStatuses\Dto\GetStatusesDto;
use App\Modules\API\GetStatuses\Exception\RequestException;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

class GetStatusesService
{
    public const TOKEN = 'ba67df6a-a17c-476f-8e95-bcdb75ed3958';

    /**
     * @throws RequestException
     */
    public function getStatuses(GetStatusesDto $dto): string
    {
        $client = HttpClient::create();

        try {
            $response = $client->request('POST', 'https://crm.belmar.pro/api/v1/getstatuses', [
                'headers' => [
                    'token' => self::TOKEN
                ],
                'json' => [
                    'date_from' => $dto->date_from,
                    'date_to' => $dto->date_to,
                    'page' => $dto->page,
                    'limit' => $dto->limit
                ]
            ]);

        }catch (TransportExceptionInterface $e) {
            throw new RequestException($e->getMessage());
        }

        return $response->getContent();
    }

}