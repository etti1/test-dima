<?php

namespace App\Modules\API\AddLead\Dto;

class AddLeadDto
{
    public function __construct(
        public string $firstName,
        public string $lastName,
        public int $phone,
        public string $email,
    )
    {
    }
}
