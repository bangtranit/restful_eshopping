<?php

namespace App;
use App\Transaction;
use App\Scopes\BuyerScope;
use App\Transformers\BuyerTransformer;
use Illuminate\Database\Eloquent\SoftDeletes;
class Buyer extends User
{
	        
    use softDeletes;

    public $transformer = BuyerTransformer::class;

    protected $dates = ['deleted_at'];

	protected static function boot(){
		parent::boot();
		static::addGlobalScope(new BuyerScope);
	}

    public function transactions(){
    	return $this->hasMany(Transaction::class);
    }
}
