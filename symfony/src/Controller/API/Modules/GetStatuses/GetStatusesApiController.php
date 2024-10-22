<?php

namespace App\Controller\API\Modules\GetStatuses;

use App\Modules\API\GetStatuses\Dto\GetStatusesDto;
use App\Modules\API\GetStatuses\Exception\RequestException;
use App\Modules\API\GetStatuses\Service\GetStatusesService;
use Nelmio\ApiDocBundle\Annotation\Model;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;
use App\Modules\API\AddLead\Dto\AddLeadDto;
use App\Modules\API\AddLead\Service\AddLeadService;
use Symfony\Component\HttpFoundation\Response;
use OpenApi\Attributes as OA;

class GetStatusesApiController extends AbstractController
{
    public function __construct(
        private readonly GetStatusesService $getStatusesService,
        private readonly SerializerInterface $serializer,
    )
    {
    }


    /**
     * @throws RequestException
     */
    #[Route(
        path: 'api/get/lead',
        methods: [Request::METHOD_POST]

    )]
    #[OA\Post(path: 'api/get/lead')]
    #[OA\RequestBody(
        required: true,
        content: new OA\JsonContent(ref: new Model(type: GetStatusesDto::class))
    )]
    #[OA\Response(
        response: Response::HTTP_OK,
        description: 'Success'
    )]
    public function get(Request $request): JsonResponse
    {
        $dto = $this->serializer->deserialize(
            $request->getContent(),
            GetStatusesDto::class,
            'json'
        );

        $statuses = json_decode($this->getStatusesService->getStatuses($dto), true);

        return new JsonResponse($statuses);
    }
}
