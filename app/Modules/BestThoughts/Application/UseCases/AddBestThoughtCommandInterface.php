<?php

namespace App\Modules\BestThoughts\Application\UseCases;

interface AddBestThoughtCommandInterface
{
    /**
     * @param string $text
     * @param int $userId
     * @return mixed
     */
    public function execute(string $text, int $userId);
}
