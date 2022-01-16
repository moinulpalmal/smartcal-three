<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class InterliningProductSetup extends Model
{
    public static function getActiveProductListForSelect($supplier_id){
        return DB::table('interlining_product_price_setups')
            ->join('interlining_product_setups', 'interlining_product_setups.id', '=', 'interlining_product_price_setups.interlining_product_setup_id')
            ->select('interlining_product_setups.name', 'interlining_product_setups.id')
            ->where('interlining_product_price_setups.supplier_id', $supplier_id)
            ->where('interlining_product_setups.status', 'A')
            ->where('interlining_product_price_setups.status', 'A')
            ->groupBy('interlining_product_setups.name', 'interlining_product_setups.id')
            ->orderBy('interlining_product_setups.name')
            ->get();
    }
}
