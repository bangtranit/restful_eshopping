<?php

namespace App\Http\Controllers\Seller;

use App\Seller;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class SellerCategory extends ApiController
{
    public function __construct(){
        $this->middleware('auth:api');
//        $this->middleware('read-general')->only(['index']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Seller $seller)
    {
        //
        $categories = $seller->products()
                            ->whereHas('categories')
                            ->with('categories')
                            ->get()
                            ->pluck('categories')
                            ->collapse()
                            ->unique('id')
                            ->values();
        return $this->showAll($categories);
    }

}
