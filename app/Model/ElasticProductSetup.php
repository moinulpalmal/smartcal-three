<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ElasticProductSetup extends Model
{
    public static function getActiveProductListForSelect($supplier_id){
        return DB::table('elastic_product_price_setups')
            ->join('elastic_product_setups', 'elastic_product_setups.id', '=', 'elastic_product_price_setups.elastic_product_setup_id')
            ->select('elastic_product_setups.name', 'elastic_product_setups.id')
            ->where('elastic_product_price_setups.supplier_id', $supplier_id)
            ->where('elastic_product_setups.status', 'A')
            ->where('elastic_product_price_setups.status', 'A')
            ->groupBy('elastic_product_setups.name', 'elastic_product_setups.id')
            ->orderBy('elastic_product_setups.name')
            ->get();
    }
}
