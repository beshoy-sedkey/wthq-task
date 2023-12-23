<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Repository\Contract\ProductRepositoryInterface;
use Illuminate\Http\Request;

class ProductController extends Controller
{


    /**
     * @var ProductRepositoryInterface
     */
    private ProductRepositoryInterface $productRepo;

    /**
     * __construct
     * @param ProductRepositoryInterface $userRepo
     */
    public function __construct(ProductRepositoryInterface $productRepo)
    {
        $this->productRepo = $productRepo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->responseSuccess(ProductResource::collection($this->productRepo->getAll()) , 'Get All Products Successfully' , 200);

    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateProductRequest $request)
    {
        try {
            $user = $this->productRepo->createProduct($request->validated());
        } catch (\Throwable $th) {
            return $this->responseException($th);
        }
        return $this->responseSuccess(ProductResource::make($user),'Product Created Succefully', 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $user = $this->productRepo->showProductById($product->id);
        return $this->responseSuccess(ProductResource::make($user) , 'Show Product Succefully' , 200);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        try {
            $this->productRepo->updateProduct($product->id, $request->validated());
        } catch (\Throwable $th) {
            return $this->responseException($th);
        }
        return $this->responseWithoutData('Product Updated Successfully', 202);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        try {
            $this->productRepo->deleteProduct($product->id);
       } catch (\Throwable $th) {
           return $this->responseException($th);
       }
       return $this->responseWithoutData('Product deleted Successfully', 202);

    }
}
