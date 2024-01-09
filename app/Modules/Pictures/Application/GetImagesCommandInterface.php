<?php

namespace App\Modules\Pictures\Application;


interface GetImagesCommandInterface
{
    /**
     * @param int $userId
     * @param int $page
     * @return mixed
     */
    public function execute(int $userId, int $page);
}
