<?php

namespace App\Modules\BestThoughts\Application\UseCases;

use App\Modules\BestThoughts\Application\DTO\BestThoughtDTO;
use App\Modules\BestThoughts\Domain\BestThought;
use App\Modules\BestThoughts\Domain\BestThoughtRepositoryInterface;

class AddBestThoughtCommand
{

    /**
     * @param BestThoughtRepositoryInterface $bestThoughtRepository
     */
    public function __construct(private BestThoughtRepositoryInterface $bestThoughtRepository)
    {
    }

    /**
     * @param string $text
     * @return mixed
     */
    public function execute(string $text): BestThoughtDTO{
        $bestThought = new BestThought();

        $bestThoughtDTO = $this->bestThoughtRepository->addBestThought($bestThought->guid,$text);

        return $bestThoughtDTO;
    }
}
