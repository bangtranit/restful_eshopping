<?php

namespace App\Http\Controllers\Buyer;

use App\Buyer;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class BuyerCategoryController extends ApiController
{
    public function __construct(){
        $this->middleware('auth:api');
//        $this->middleware('read-general')->only(['index']);
//        $this->middleware('can:view, buyer')->only(['index']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Buyer $buyer)
    {
        $categories = $buyer->transactions()
                        ->with('product.categories')
                        ->get()
                        ->pluck('product.categories')
                        ->collapse()
                        ->unique('id')
                        ->values();
        return $this->showAll($categories);
    }

}
