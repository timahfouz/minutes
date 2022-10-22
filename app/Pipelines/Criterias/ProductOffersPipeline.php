<?php

namespace App\Pipelines\Criterias;

use App\Pipelines\PipelineFactory;

class ProductOffersPipeline extends PipelineFactory
{
    private $categoryId;

    public function __construct($categoryId = null)
    {
        $this->categoryId = $categoryId;
    }
    
    protected function apply($builder)
    {
        $url = env('APP_URL');
        $builder = $builder->selectRaw("offers.*, p.category_id, p.name, p.price, CONCAT('$url','/',m.path) as image_path, c.name as category_name")
            ->leftJoin('products as p', function($join) {
                $join->on('p.id','=','offers.product_id');
            })
            ->leftJoin('categories as c', function($join) {
                $join->on('c.id','=','p.category_id');
            })
            ->leftJoin('media as m', function($join) {
                $join->on('m.id','=','p.image_id');
            })
            ->where('is_offer_expired', false);

        if ($this->categoryId) {
            $builder = $builder->where('p.category_id', $this->categoryId);
        }
        $builder = $builder->orderBy('p.category_id', 'ASC');

        return $builder;
    }
}
