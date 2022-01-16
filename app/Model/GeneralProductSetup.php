<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class GeneralProductSetup extends Model
{
    public static function getActiveProductListForSelect($supplier_id){
        return DB::table('general_product_price_setups')
            ->join('general_product_setups', 'general_product_setups.id', '=', 'general_product_price_setups.general_product_setup_id')
            ->select('general_product_setups.name', 'general_product_setups.id', 'general_product_price_setups.currency')
            ->where('general_product_price_setups.supplier_id', $supplier_id)
            ->where('general_product_setups.status', 'A')
            ->where('general_product_price_setups.status', 'A')
            ->groupBy('general_product_setups.name', 'general_product_setups.id', 'general_product_price_setups.currency')
            ->orderBy('general_product_setups.name')
            ->get();
    }
}
