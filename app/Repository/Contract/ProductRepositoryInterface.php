<?php

namespace App\Repository\Contract;

use App\Repository\BaseContract;
use Illuminate\Database\Eloquent\Collection;

interface ProductRepositoryInterface extends BaseContract {

    public function updateProduct(int $id , $data):bool;
    public function createProduct(array $data);
    public function getAll():Collection;
    public function deleteProduct(int $id): bool;
    public function showProductById(int $id): object;

}
