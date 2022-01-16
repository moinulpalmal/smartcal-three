<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TissuePurchaseOrderDetail extends Model
{
    public static function getElasticPODetails($masterId){
        return DB::table('tissue_purchase_order_details')
            ->where('purchase_order_master_id', $masterId)
            ->where('status' , '!=', 'D')
            ->get();
    }

    public static function getUniqueProducts($masterId){

        return DB::table('tissue_purchase_order_details')
            ->join('tissue_product_setups', 'tissue_purchase_order_details.tissue_product_setup_id', '=', 'tissue_product_setups.id')
            ->select('tissue_product_setups.id', 'tissue_product_setups.name')
            ->where('purchase_order_master_id', $masterId)
            ->where('tissue_purchase_order_details.status' , '!=', 'D')
            ->orderBy('tissue_product_setups.name')
            ->groupBy('tissue_purchase_order_details.tissue_product_setup_id', 'tissue_product_setups.id', 'tissue_product_setups.name')
            ->get();
    }
}
