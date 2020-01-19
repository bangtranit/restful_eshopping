<?php

namespace App\Http\Controllers\Category;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class CategoryBuyerController extends ApiController
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
    public function index(Category $category)
    {
        //
        $buyers = $category->products()
                    ->whereHas('transactions')
                    ->with('transactions.buyer')
                    ->get()
                    ->pluck('transactions')
                    ->collapse()
                    ->pluck('buyer')
                    ->unique('id')
                    ->values();

        return $this->showAll($buyers);               
    }

}
