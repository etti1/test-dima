<?php

namespace App\Controller\API\Modules\AddLead;

use App\Modules\API\AddLead\Dto\AddLeadDto;
use App\Modules\api\AddLead\Exception\RequestException;
use App\Modules\API\AddLead\Service\AddLeadService;
use Nelmio\ApiDocBundle\Annotation\Model;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use OpenApi\Attributes as OA;
use Symfony\Component\Serializer\SerializerInterface;

class AddLeadApiController extends AbstractController
{
    public function __construct(
        private readonly AddLeadService $addLeadService,
        private readonly SerializerInterface $serializer
    )
    {
    }

    /**
     * @throws RequestException
     */
    #[Route(
        path: 'api/add/lead',
        methods: [Request::METHOD_POST]

    )]
    #[OA\Post(path: 'api/add/lead')]
    #[OA\RequestBody(
        required: true,
        content: new OA\JsonContent(ref: new Model(type: AddLeadDto::class))
    )]
    #[OA\Response(
        response: Response::HTTP_OK,
        description: 'Success'
    )]
    public function add(Request $request): JsonResponse
    {
        $dto = $this->serializer->deserialize(
            $request->getContent(),
            AddLeadDto::class,
            'json'
        );

        return $this->addLeadService->addLead($request,$dto);
    }

}
