<?php

namespace App\Modules\BestThoughts\Application;

use App\Modules\BestThoughts\Domain\BestThoughtRepositoryInterface;

class AddBestThoughtCommand
{

    public function __construct(BestThoughtRepositoryInterface $bestThoughtRepository)
    {
    }

    public function addBestThought(){

    }
}
