<?php

namespace App\Transformers;
use App\Seller;
use League\Fractal\TransformerAbstract;

class SellerTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Seller $seller)
    {
        return [
            'identifier' => (int)$seller->id,
            'name' => (string)$seller->name,
            'email' => (string)$seller->email,
            'isVerified' => (int)$seller->verified,
            'creationDate' => (string)$seller->created_at,
            'lastchange' => (string)$seller->updated_at,
            'deleteDate' => isset($seller->deleted_at) ? (string)$seller->deleted_at : null,

            'links' => [
                [
                    'rel' => 'self',
                    'href' => route('sellers.show', $seller->id),
                ],
                [
                    'rel' => 'sellers.buyers',
                    'href' => route('sellers.buyers.index', $seller->id),
                ],
                [
                    'rel' => 'sellers.categories',
                    'href' => route('sellers.categories.index', $seller->id),
                ],
                [
                    'rel' => 'sellers.products',
                    'href' => route('sellers.products.index', $seller->id),
                ],
                [
                    'rel' => 'sellers.transactions',
                    'href' => route('sellers.transactions.index', $seller->id),
                ],
                [
                    'rel' => 'sellers.show',
                    'href' => route('sellers.show', $seller->id),
                ]
            ]
        ];
    }
    
    public static function originalAttribute($index){
        $attributes = [
            'identifier' => 'id',
            'name' => 'name',
            'email' => 'email',
            'isVerified' => 'verified',
            'creationDate' => 'created_at',
            'lastchange' => 'updated_at',
            'deleteDate' => 'deleted_at',
        ];
        return isset($attributes[$index]) ? $attributes[$index] : null;
    }

    public static function tranformedAttribute($index){
        $attributes = [
            'id' => 'identifier',
            'name' => 'name',
            'email' => 'email',
            'verified' => 'isVerified',
            'created_at' => 'creationDate',
            'updated_at' => 'lastchange',
            'deleted_at' => 'deleteDate',
        ];
        return isset($attributes[$index]) ? $attributes[$index] : null;
    }









}
