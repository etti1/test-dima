<?php

namespace App\Modules\API\GetStatuses\Dto;

class GetStatusesDto
{
    public function __construct(
        public ?\DateTime $date_from = null,
        public ?\DateTime $date_to = null,
        public ?int $page = null,
        public ?int $limit = null,
    )
    {
    }


}