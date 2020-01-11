<?php

namespace App\Http\Controllers\Seller;

use App\Seller;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class SellerBuyerController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Seller $seller)
    {
        //
        $buyers = $seller->products()
                    ->whereHas('transactions')
                    ->with('transactions.buyer')
                    ->get()
                    ->pluck('transactions')
                    ->collapse()
                    ->unique('id')
                    ->values();
        return $this->showAll($buyers);
    }
}
