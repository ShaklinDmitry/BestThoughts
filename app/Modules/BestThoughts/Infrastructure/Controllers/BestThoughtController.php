<?php

namespace App\Modules\BestThoughts\Infrastructure\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\BestThoughts\Application\UseCases\AddBestThoughtCommandInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BestThoughtController extends Controller
{
    /**
     * @param Request $request
     * @param AddBestThoughtCommandInterface $addBestThoughtCommand
     * @return \Illuminate\Http\JsonResponse|void
     */
    public function addBestThought(Request $request, AddBestThoughtCommandInterface $addBestThoughtCommand){
        $userId = Auth::id();

        $validatedData = $request->validate([
            'text' => 'required',
        ]);

        $bestThoughtDTO = $addBestThoughtCommand->execute($validatedData['text'], $userId);

        if($bestThoughtDTO){
            $responseData = [
                "data" => [
                    "message" => "Best thought was added.",
                    "bestThought" => $bestThoughtDTO->toArray()
                ]
            ];

            return response()->json($responseData, 201);

        }

    }

    public function getBestThoughts(Request $request){

    }
}
