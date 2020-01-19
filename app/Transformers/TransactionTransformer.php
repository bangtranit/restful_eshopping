<?php

namespace App\Transformers;
use App\Transaction;
use League\Fractal\TransformerAbstract;

class TransactionTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Transaction $transaction)
    {
        return [
            'identifier' => (int)$transaction->id,
            'quantity' => (int)$transaction->quantity,
            'buyer' => (int)$transaction->buyer_id,
            'product_id' => (int)$transaction->product_id,
            'creationDate' => (string)$transaction->created_at,
            'lastchange' => (string)$transaction->updated_at,
            'deleteDate' => isset($transaction->deleted_at) ? (string)$transaction->deleted_at : null,

            'links' => [
                [
                    'rel' => 'self',
                    'href' => route('transactions.show', $transaction->id),
                ],
                [
                    'rel' => 'transaction.categories',
                    'href' => route('transactions.categories.index', $transaction->id),
                ],
                [
                    'rel' => 'transaction.seller',
                    'href' => route('transactions.sellers.index', $transaction->id),
                ],
                [
                    'rel' => 'buyer',
                    'href' => route('buyers.show', $transaction->buyer_id),
                ],
                [
                    'rel' => 'product',
                    'href' => route('products.show', $transaction->product_id),
                ],
            ]
        ];
    }

    public static function originalAttribute($index){
    $attributes = [
        'identifier' => 'id',
        'quantity' => 'quantity',
        'buyer' => 'buyer_id',
        'product_id' => 'product_id',
        'creationDate' => 'created_at',
        'lastchange' => 'updated_at',
        'deleteDate' => 'deleted_at',
    ];
    return isset($attributes[$index]) ? $attributes[$index] : null;
    }

    public static function transformedAttribute($index){
        $attributes = [
            'id' => 'identifier',
            'quantity' => 'quantity',
            'buyer_id' => 'buyer',
            'product_id' => 'product_id',
            'created_at' => 'creationDate',
            'updated_at' => 'lastchange',
            'deleted_at' => 'deleteDate',
        ];
        return isset($attributes[$index]) ? $attributes[$index] : null;
    }









}
