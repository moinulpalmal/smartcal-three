<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PolyPODetail extends Model
{
    public static function getElasticPODetails($masterId){
        return DB::table('poly_p_o_details')
            ->where('purchase_order_master_id', $masterId)
            ->where('status' , '!=', 'D')
            ->get();
    }

    public static function getUniqueProducts($masterId){

        return DB::table('poly_p_o_details')
            ->join('poly_product_setups', 'poly_p_o_details.poly_product_setup_id', '=', 'poly_product_setups.id')
            ->select('poly_p_o_details.item_details AS name')
            ->where('purchase_order_master_id', $masterId)
            ->where('poly_p_o_details.status' , '!=', 'D')
            ->orderBy('poly_p_o_details.item_details')
            ->groupBy('poly_p_o_details.item_details')
            ->get();
    }

    public static function getTotalQuantity($masterId){
        $poDetails = DB::table('poly_p_o_details')
            ->select('poly_p_o_details.order_quantity', 'poly_p_o_details.total_price')
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
        $poDetails = DB::table('poly_p_o_details')
            ->select('poly_p_o_details.order_quantity', 'poly_p_o_details.total_price')
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
