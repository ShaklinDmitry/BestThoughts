<?php

namespace App\Modules\BestThoughts\Application\UseCases;

use App\Modules\BestThoughts\Application\DTO\BestThoughtDTO;
use App\Modules\BestThoughts\Domain\BestThought;
use App\Modules\BestThoughts\Domain\BestThoughtRepositoryInterface;

class AddBestThoughtCommand implements AddBestThoughtCommandInterface
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
    public function execute(string $text, int $userId): BestThoughtDTO{
        $bestThought = new BestThought();

        $bestThoughtDTO = $this->bestThoughtRepository->addBestThought($bestThought->guid, $text, $userId);

        return $bestThoughtDTO;
    }
}
