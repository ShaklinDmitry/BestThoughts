<?php

namespace App\Modules\BestThoughts\Application\UseCases;

use App\Modules\BestThoughts\Application\DTO\BestThoughtDTOCollection;

interface GetBestThoughtsCommandInterface
{
    /**
     * @param int $userId
     * @return BestThoughtDTOCollection
     */
    public function execute(int $userId):BestThoughtDTOCollection;
}
