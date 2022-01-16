<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PolyProductSetup extends Model
{
    public static function getActiveProductListForSelect($supplier_id){
        return DB::table('poly_product_price_setups')
            ->join('poly_product_setups', 'poly_product_setups.id', '=', 'poly_product_price_setups.poly_product_setup_id')
            ->select('poly_product_setups.name', 'poly_product_setups.id')
            ->where('poly_product_price_setups.supplier_id', $supplier_id)
            ->where('poly_product_setups.status', 'A')
            ->where('poly_product_price_setups.status', 'A')
            ->groupBy('poly_product_setups.name', 'poly_product_setups.id')
            ->orderBy('poly_product_setups.name')
            ->get();
    }
}
