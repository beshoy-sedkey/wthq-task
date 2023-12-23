<?php

namespace App\Repository\Contract;

use App\Repository\BaseContract;
use Illuminate\Database\Eloquent\Collection;

interface UserRepositoryInterface extends BaseContract {

    public function login($email, $password);
    public function findByEmail($email);
    public function updateUser(int $id , $data):bool;
    public function createUser(array $data);
    public function getAll():Collection;
    public function deleteUser(int $id): bool;
    public function showUserById(int $id): object;

}
