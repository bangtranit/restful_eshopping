<?php

namespace App;
use App\Product;
use App\Scopes\SellerScope;
use App\Transformers\SellerTransformer;
use Illuminate\Database\Eloquent\SoftDeletes;
class Seller extends User
{

    use softDeletes;

    public $transformer = SellerTransformer::class;

    protected $dates = ['deleted_at'];
	protected static function boot(){
		parent::boot();
		static::addGlobalScope(new SellerScope);
	}

    public function products(){
    	return $this->hasMany(Product::class);
    }
}
