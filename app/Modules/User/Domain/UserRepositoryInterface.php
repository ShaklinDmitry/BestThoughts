<?php

namespace App\Modules\User\Domain;

interface UserRepositoryInterface
{
    /**
     * @param string $guid
     * @param string $name
     * @param string $email
     * @param string $password
     * @return mixed
     */
    public function createUser(string $guid, string $name, string $email, string $password);

    /**
     * @param string $guid
     * @return string
     */
    public function createUserToken(string $guid):string;

    /**
     * @param string $email
     * @param string $password
     * @return mixed
     */
    public function getUser(string $email, string $password);
}
