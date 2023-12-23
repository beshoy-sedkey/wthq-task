<?php

namespace App\Repository\Eloquent;

use App\Models\User;
use App\Repository\BaseRepository;
use Illuminate\Support\Facades\Auth;
use App\Repository\Contract\UserRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{

    protected $model;
    public function __construct(User $model)
    {
        parent::__construct($model);
        $this->model = $model;
    }

    public function findByEmail($email)
    {
        //get user by email
        return $this->model->where('email', $email)->first();
    }

    public function login($email, $password)
    {
        //get Authorized user
        return Auth::attempt(['email' => $email, 'password' => $password]);
    }

    public function createUser(array $data)
    {
        return $this->model->create($data);
    }

    public function updateUser($id, $data): bool
    {
        return $this->update($id, $data);
    }
    public function getAll(): Collection
    {
        return $this->list();
    }
    public function deleteUser(int $id): bool
    {
        return $this->deleteById($id);
    }

    public function showUserById(int $id): User
    {
        return $this->findById($id);
    }
}
