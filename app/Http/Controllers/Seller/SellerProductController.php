<?php

namespace App\Http\Controllers\Seller;

use App\Seller;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Seller\StoreSellerProduct;
use App\Http\Requests\Seller\UpdateSellerProduct;
use Symfony\Component\HttpKernel\Exception\HttpException;

class SellerProductController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Seller $seller)
    {
        //
        $products = $seller->products()
            ->get()
            ->unique('id')
            ->values();
        return $this->showAll($products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSellerProduct $request, Seller $seller)
    {
        //
        $validated = $request->validated();
        $data = $request->all();
        $data['status'] = Product::UNAVAILABLE_PRODUCT;
        $data['image'] = $request->image->store('');//have setting on config/filesystem
        $data['seller_id'] = $seller->id;

        $product = Product::create($data);
        return $this->showOne($product);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Seller  $seller
     * @return \Illuminate\Http\Response
     */
    public function show(Seller $seller)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Seller  $seller
     * @return \Illuminate\Http\Response
     */
    public function edit(Seller $seller)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Seller  $seller
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSellerProduct $request, Seller $seller, Product $product)
    {
        //

        $validated = $request->validated();
        $this->checkSeller($seller, $product);

        echo "<pre>";
        print_r($request->all());
        echo "</pre>";

        // $product->fill($request->only([
        //     'name',
        //     'description',
        //     'quantity',
        // ]));


        // if ($request->has('status')) {
        //     $product->status = $request->status;

        //     if ($product->isAvailable() && $product->categories()->count() == 0) {
        //         return $this->errorResponse('An active product must have at least ont category', 409);
        //     }
        // }

        // if ($request->hasFile('image')) {
        //     Storage::delete($product->image);
        //     $product->status = $request->image->store('');
        // }

        // if ($product->isClean()) {
        //     return $this->showDirtyResponse();
        // }
        // $product->save();

        // return $this->showOne($product);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Seller  $seller
     * @return \Illuminate\Http\Response
     */
    public function destroy(Seller $seller, Product $product)
    {
        //
        $this->checkSeller($seller, $product);
        Storage::delete($product->image);
        $product->delete();

        return $this->showOne($product);

    }

    protected function checkSeller(Seller $seller, Product $product)
    {
        if ($seller->id != $product->seller_id) {
            throw new HttpException(422, 'The specifid seller is not the actual seller of the product');
        }
    }
}
