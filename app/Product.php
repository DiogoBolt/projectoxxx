<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Product extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function category()
    {
        return $this->belongsTo(Category::class,'category_id');
    }
    public function brand()
    {
        return $this->belongsTo(Brand::class,'brand_id');
    }

    /**
     * The photo fields should be listed here.
     *
     * @var array
     */


    protected $table = 'products';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */


}