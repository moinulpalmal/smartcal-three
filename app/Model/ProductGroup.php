<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ProductGroup extends Model
{
    public function suppliers()
    {
        return $this->belongsToMany('App\Model\Supplier');
    }

    public static function getProductGroupsForSelect(){
        return DB::table('product_groups')
            ->select('product_groups.group_name AS name', 'product_groups.id')
            ->orderBy('product_groups.group_name')
            ->get();
    }
}
