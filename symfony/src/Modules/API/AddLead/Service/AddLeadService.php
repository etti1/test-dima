<?php

namespace App\Modules\API\AddLead\Service;

use App\Modules\API\AddLead\Dto\AddLeadDto;
use App\Modules\API\AddLead\Enum\Data;
use App\Modules\API\AddLead\Exception\RequestException;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

class AddLeadService
{
    public const TOKEN = 'ba67df6a-a17c-476f-8e95-bcdb75ed3958';
    /**
     * @throws RequestException
     */
    public function addLead(Request $request,AddLeadDto $dto): JsonResponse
    {
        $client = HttpClient::create();

        $ip = $request->getClientIp();

        $host = $request->getHost();

        try {
            $response = $client->request('POST', 'https://crm.belmar.pro/api/v1/addlead', [
                'headers' => [
                    'token' => self::TOKEN
                ],
                'json' => [
                    'firstName' => $dto->firstName,
                    'lastName' => $dto->lastName,
                    'phone' => $dto->phone,
                    'email' => $dto->email,
                    'countryCode' => Data::COUNTRY_CODE,
                    'box_id' => Data::BOX_ID,
                    'offer_id' => Data::OFFER_ID,
                    'landingUrl' => $host,
                    'ip' => $ip,
                    'password' => Data::PASSWORD,
                    'language' => Data::LANGUAGE
                ]
            ]);

            dump($response->getContent());

        }catch (TransportExceptionInterface $e) {
            throw new RequestException($e->getMessage());
        }

        return new JsonResponse($response->getContent());
    }
}
