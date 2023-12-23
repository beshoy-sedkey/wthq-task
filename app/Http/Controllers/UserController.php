<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Repository\Contract\UserRepositoryInterface;

class UserController extends Controller
{

    /**
     * @var UserRepositoryInterface
     */
    private UserRepositoryInterface $userRepo;

    /**
     * __construct
     * @param UserRepositoryInterface $userRepo
     */
    public function __construct(UserRepositoryInterface $userRepo)
    {
        $this->userRepo = $userRepo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->responseSuccess(UserResource::collection($this->userRepo->getAll()) , 'Get All Users Successfully' , 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUserRequest $request)
    {
        try {
            $user = $this->userRepo->createUser($request->validated());
        } catch (\Throwable $th) {
            return $this->responseException($th);
        }
        return $this->responseSuccess(UserResource::make($user),'User Created Succefully', 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $user = $this->userRepo->showUserById($user->id);
        return $this->responseSuccess(UserResource::make($user) , 'Show User Succefully' , 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(User $user, UpdateUserRequest $request)
    {
        try {
            $user =  $this->userRepo->updateUser($user->id, $request->validated());
        } catch (\Throwable $th) {
            return $this->responseException($th);
        }
        return $this->responseWithoutData('User Updated Successfully', 202);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        try {
             $this->userRepo->deleteUser($user->id);
        } catch (\Throwable $th) {
            return $this->responseException($th);
        }
        return $this->responseWithoutData('User deleted Successfully', 202);

    }
}
