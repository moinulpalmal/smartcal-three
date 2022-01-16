<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class FabricProductSetup extends Model
{
    public static function getActiveProductListForSelect($supplier_id){
        return DB::table('fabric_product_price_setups')
            ->join('fabric_product_setups', 'fabric_product_setups.id', '=', 'fabric_product_price_setups.fabric_product_setup_id')
            ->select('fabric_product_setups.name', 'fabric_product_setups.id')
            ->where('fabric_product_price_setups.supplier_id', $supplier_id)
            ->where('fabric_product_setups.status', 'A')
            ->where('fabric_product_price_setups.status', 'A')
            ->groupBy('fabric_product_setups.name', 'fabric_product_setups.id')
            ->orderBy('fabric_product_setups.name')
            ->get();
    }
}
