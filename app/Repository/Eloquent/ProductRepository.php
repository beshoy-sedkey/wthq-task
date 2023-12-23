<?php

namespace App\Repository\Eloquent;

use App\Models\User;
use App\Models\Product;
use Illuminate\Support\Str;

use App\Repository\BaseRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use App\Repository\Contract\ProductRepositoryInterface;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{

    protected $model;
    public function __construct(Product $model)
    {
        parent::__construct($model);
        $this->model = $model;
    }

    public function createProduct(array $data)
    {
        return $this->model->create($data);
    }

    public function updateProduct($id, $data): bool
    {
        return $this->update($id, $data);
    }

    public function getAll(): Collection
    {
        return $this->list();
    }

    public function deleteProduct(int $id): bool
    {
        return $this->deleteById($id);
    }

    public function showProductById(int $id): Product
    {
        return $this->findById($id);
    }
}
