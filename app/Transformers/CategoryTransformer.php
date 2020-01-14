<?php

namespace App\Transformers;
use App\Category;
use League\Fractal\TransformerAbstract;

class CategoryTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Category $category)
    {
        return [
           'identifier' => (int)$category->id,
            'title' => (string)$category->name,
            'details' => (string)$category->description,
            'creationDate' => (string)$category->created_at,
            'lastchange' => (string)$category->updated_at,
            'deleteDate' => isset($category->deleted_at) ? (string)$category->deleted_at : null,

        ];
    }
}
