<?php

namespace App\Pipelines\Criterias;

class ProductOffersPipeline
{
    private $model;

    public function __construct($model)
    {
        $namespace = 'App\\Models\\';
        $class = $namespace . $model;
        $this->model = new $class();
    }


    public function apply()
    {
        $url = env('APP_URL');
        $sql = $builder = clone $this->model;

        $result = [];
        $categories = $sql->select('category_id')->distinct()->get();
        foreach($categories as $category) {
            $ref = $category->category;
            $categ = [];
            $categ['category'] = [
                'id' => $category->category_id,
                'name' => $ref->name,
                'color' => '0XFF'.str_replace('#','', $ref->color),
            ];
            
            $categ['products'] = $builder->selectRaw("offers.product_id, offers.new_price, offers.new_unit, offers.title, p.name, p.in_stock, p.price, ROUND(((p.price - offers.new_price) / p.price) * 100, 1) as discount, CONCAT('$url','/',m.path) as image_path")
            ->leftJoin('products as p', function($join) {
                $join->on('p.id','=','offers.product_id');
            })
            ->leftJoin('media as m', function($join) {
                $join->on('m.id','=','p.image_id');
            })
            ->where('is_offer_expired', false)
            ->where('offers.category_id', $category->category_id)
            ->get();

            $result[] = $categ;
        }
        return $result;
    }
}
