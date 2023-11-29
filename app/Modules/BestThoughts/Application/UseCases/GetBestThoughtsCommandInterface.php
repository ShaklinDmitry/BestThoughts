<?php

namespace App\Modules\BestThoughts\Application\UseCases;

interface GetBestThoughtsCommandInterface
{
    /**
     * @param int $userId
     * @return mixed
     */
    public function execute(int $userId);
}
