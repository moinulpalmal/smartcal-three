<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ProductGroup extends Model
{
    public function suppliers()
    {
        return $this->belongsToMany('App\Model\Supplier');
    }
}
