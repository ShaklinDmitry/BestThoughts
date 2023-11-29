<?php

namespace App\Modules\BestThoughts\Application\UseCases;

use App\Modules\BestThoughts\Domain\BestThoughtRepositoryInterface;

class GetBestThoughtsCommand implements GetBestThoughtsCommandInterface
{
    /**
     * @param BestThoughtRepositoryInterface $bestThoughtRepository
     */
    public function __construct(private BestThoughtRepositoryInterface $bestThoughtRepository)
    {
    }

    public function execute(int $userId)
    {
        // TODO: Implement execute() method.
    }
}
