<?php

namespace App\Modules\BestThoughts\Application\UseCases;

use App\Modules\BestThoughts\Application\DTO\BestThoughtDTO;

interface AddBestThoughtCommandInterface
{
    /**
     * @param string $text
     * @param int $userId
     * @return mixed
     */
    public function execute(string $text, int $userId): BestThoughtDTO;
}
