<?php

namespace App\Modules\BestThoughts\Application\UseCases;

use App\Modules\BestThoughts\Application\DTO\BestThoughtDTOCollection;
use App\Modules\BestThoughts\Domain\BestThoughtRepositoryInterface;

final class GetBestThoughtsCommand implements GetBestThoughtsCommandInterface
{
    /**
     * @param BestThoughtRepositoryInterface $bestThoughtRepository
     */
    public function __construct(private BestThoughtRepositoryInterface $bestThoughtRepository)
    {
    }

    /**
     * @param int $userId
     * @return BestThoughtDTOCollection
     */
    public function execute(int $userId): BestThoughtDTOCollection
    {
        $bestThoughtsDTOCollection = $this->bestThoughtRepository->getBestThought($userId);
        return $bestThoughtsDTOCollection;
    }
}
