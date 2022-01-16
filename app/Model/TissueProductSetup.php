<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TissueProductSetup extends Model
{
    public static function getActiveProductListForSelect($supplier_id){
        return DB::table('tissue_product_price_setups')
            ->join('tissue_product_setups', 'tissue_product_setups.id', '=', 'tissue_product_price_setups.tissue_product_setup_id')
            ->select('tissue_product_setups.name', 'tissue_product_setups.id')
            ->where('tissue_product_price_setups.supplier_id', $supplier_id)
            ->where('tissue_product_setups.status', 'A')
            ->where('tissue_product_price_setups.status', 'A')
            ->groupBy('tissue_product_setups.name', 'tissue_product_setups.id')
            ->orderBy('tissue_product_setups.name')
            ->get();
    }
}
