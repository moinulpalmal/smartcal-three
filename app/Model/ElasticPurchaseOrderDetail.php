<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ElasticPurchaseOrderDetail extends Model
{
    public static function getElasticPODetails($masterId){
        return DB::table('elastic_purchase_order_details')
            ->where('purchase_order_master_id', $masterId)
            ->where('status' , '!=', 'D')
            ->get();
    }

    public static function getUniqueProducts($masterId){

        return DB::table('elastic_purchase_order_details')
            ->join('elastic_product_setups', 'elastic_purchase_order_details.elastic_product_setup_id', '=', 'elastic_product_setups.id')
            ->select('elastic_product_setups.id', 'elastic_product_setups.name')
            ->where('purchase_order_master_id', $masterId)
			->where('elastic_purchase_order_details.status' , 'A')
            ->orderBy('elastic_product_setups.name')
            ->groupBy('elastic_purchase_order_details.elastic_product_setup_id', 'elastic_product_setups.id', 'elastic_product_setups.name')
            ->get();
    }

    public static function getTotalQuantity($masterId){
        $poDetails = DB::table('elastic_purchase_order_details')
            ->select('elastic_purchase_order_details.order_quantity', 'elastic_purchase_order_details.total_price')
            ->where('purchase_order_master_id', $masterId)
            ->where('status' , '!=', 'D')
            ->get();

        $total_order_quantity = 0;
        //$sum_total_price = 0;

        foreach ($poDetails as $detail){
            $total_order_quantity = $total_order_quantity + (float)$detail->order_quantity;
            //$sum_total_price = $sum_total_price + (float)$detail->total_price;
        }



        return $total_order_quantity;
    }

    public static function getSumTotalPrice($masterId){
        $poDetails = DB::table('elastic_purchase_order_details')
            ->select('elastic_purchase_order_details.order_quantity', 'elastic_purchase_order_details.total_price')
            ->where('purchase_order_master_id', $masterId)
            ->where('status' , '!=', 'D')
            ->get();
        //$total_order_quantity = 0;
        $sum_total_price = 0;
        foreach ($poDetails as $detail){
            //$total_order_quantity = $total_order_quantity + (float)$detail->order_quantity;
            $sum_total_price = $sum_total_price + (float)$detail->total_price;
        }

        return $sum_total_price;

    }
}
