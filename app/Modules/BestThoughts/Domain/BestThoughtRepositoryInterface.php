<?php

namespace App\Modules\BestThoughts\Domain;

interface BestThoughtRepositoryInterface
{
    /**
     * @param string $guid
     * @param string $text
     * @return mixed
     */
    public function addBestThought(string $guid, string $text, int $userId);


    public function getBestThought($userId);
}
