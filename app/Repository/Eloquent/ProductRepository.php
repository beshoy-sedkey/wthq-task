<?php

namespace App\Repository\Eloquent;

use App\Models\User;
use App\Models\Product;
use Illuminate\Support\Str;

use App\Repository\BaseRepository;
use Illuminate\Support\Facades\DB;
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

    public function createWithPriceModifiers(array $productData, array $priceModifiers = [])
    {
        return DB::transaction(function () use ($productData, $priceModifiers) {
            $product = Product::create($productData);
            foreach ($priceModifiers as $modifier) {
                $product->priceModifiers()->create($modifier);
            }
            return $product;
        });
    }

    /**
     * 
     * @param int $product_id
     * @param object $user
     *
     * @return object
     */
    public function showSpecificProductPriceForLoggedInUser(int $product_id, object $user): object
    {
        $user_type = $user->type;
        return $this->model->with('priceModifiers')->where('id', $product_id)->get()->map(function ($q) use ($user_type) {
            return $q->priceModifiers->where('user_type' , $user_type);
        });
    }
}
