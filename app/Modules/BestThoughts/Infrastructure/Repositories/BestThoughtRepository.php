<?php

namespace App\Modules\BestThoughts\Infrastructure\Repositories;

use App\Models\BestThought;
use App\Modules\BestThoughts\Application\DTO\BestThoughtDTO;
use App\Modules\BestThoughts\Application\DTO\BestThoughtDTOCollection;
use App\Modules\BestThoughts\Domain\BestThoughtRepositoryInterface;

final class BestThoughtRepository implements BestThoughtRepositoryInterface
{

    /**
     * @param string $guid
     * @param string $text
     * @param int $userId
     * @return BestThoughtDTO
     */
    public function addBestThought(string $guid, string $text, int $userId):BestThoughtDTO
    {
        $bestThought = BestThought::create(
            [
                'guid' => $guid,
                'text' => $text,
                'user_id' => $userId
            ]
        );

        return new BestThoughtDTO(guid: $guid, text: $text, userId: $userId);
    }


    /**
     * @param $userId
     * @return BestThoughtDTOCollection
     */
    public function getBestThought($userId):BestThoughtDTOCollection
    {
        $bestThoughts = BestThought::where('user_id', $userId)->get();

        $collection = array();
        foreach ($bestThoughts as $bestThought){
            $bestThoughtDTO = new BestThoughtDTO($bestThought->text, $bestThought->guid, $bestThought->user_id);
            $collection[] = $bestThoughtDTO;
        }
        $bestThoughtDTOCollection = new BestThoughtDTOCollection($collection);
        return $bestThoughtDTOCollection;
    }

}
