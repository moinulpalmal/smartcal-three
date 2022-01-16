<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class FabricPurchaseOrderDetail extends Model
{
    public static function getElasticPODetails($masterId){
        return DB::table('fabric_purchase_order_details')
            ->where('purchase_order_master_id', $masterId)
            ->where('status' , '!=', 'D')
            ->get();
    }

    public static function getUniqueProducts($masterId){

        return DB::table('fabric_purchase_order_details')
            ->join('fabric_product_setups', 'fabric_purchase_order_details.fabric_product_setup_id', '=', 'fabric_product_setups.id')
            ->select('fabric_product_setups.id', 'fabric_product_setups.name')
            ->where('purchase_order_master_id', $masterId)
            ->orderBy('fabric_product_setups.name')
            ->groupBy('fabric_purchase_order_details.fabric_product_setup_id', 'fabric_product_setups.id', 'fabric_product_setups.name')
            ->get();
    }
}
