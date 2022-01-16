<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CartoonPurchaseOrderDetail extends Model
{
    public static function getCartoonPODetails($masterId){
        return DB::table('cartoon_purchase_order_details')
            ->where('purchase_order_master_id', $masterId)
            ->where('status' , '!=', 'D')
            ->orderBy('cartoon_purchase_order_details.input_unit_id', 'desc')
            ->get();
    }

    public static function getUniqueProducts($masterId){

        return DB::table('cartoon_purchase_order_details')
            ->join('cartoon_product_setups', 'cartoon_purchase_order_details.cartoon_product_setup_id', '=', 'cartoon_product_setups.id')
            ->select('cartoon_product_setups.id', 'cartoon_product_setups.name', 'cartoon_product_setups.is_board')
            ->where('purchase_order_master_id', $masterId)
            ->where('cartoon_purchase_order_details.status' , '!=', 'D')
            ->orderBy('cartoon_product_setups.name')
            ->groupBy('cartoon_product_setups.is_board', 'cartoon_purchase_order_details.cartoon_product_setup_id', 'cartoon_product_setups.id', 'cartoon_product_setups.name')
            ->get();
    }

    public static function getTotalQuantity($masterId){
        $poDetails = DB::table('cartoon_purchase_order_details')
            ->select('cartoon_purchase_order_details.order_quantity', 'cartoon_purchase_order_details.total_price')
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
        $poDetails = DB::table('cartoon_purchase_order_details')
            ->select('cartoon_purchase_order_details.order_quantity', 'cartoon_purchase_order_details.total_price')
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
