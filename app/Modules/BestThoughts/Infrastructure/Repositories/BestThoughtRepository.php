<?php

namespace App\Modules\BestThoughts\Infrastructure\Repositories;

use App\Models\BestThought;
use App\Modules\BestThoughts\Application\DTO\BestThoughtDTO;
use App\Modules\BestThoughts\Domain\BestThoughtRepositoryInterface;

class BestThoughtRepository implements BestThoughtRepositoryInterface
{

    /**
     * @param string $guid
     * @param string $text
     * @return BestThoughtDTO
     */
    public function addBestThought(string $guid, string $text)
    {
        $bestThought = BestThought::create(
            [
                'guid' => $guid,
                'text' => $text
            ]
        );

        return new BestThoughtDTO(guid: $guid, text: $text);
    }
}
