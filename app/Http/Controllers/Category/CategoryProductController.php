<?php

namespace App\Http\Controllers\Category;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class CategoryProductController extends ApiController
{
    public function __construct(){
        // parent::__construct();
        $this->middleware('client.credentials')->only(['index']);
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
        $products = $category->products()
                    ->get()
                    ->unique('id')
                    ->values();
        return $this->showAll($products);
    }

}
