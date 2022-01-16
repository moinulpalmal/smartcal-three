<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ThreadPODetail extends Model
{
    public static function getElasticPODetails($masterId){
        return DB::table('thread_p_o_details')
            ->where('purchase_order_master_id', $masterId)
            ->where('status' , '!=', 'D')
            ->get();
    }

    public static function getUniqueProducts($masterId){

        return DB::table('thread_p_o_details')
            ->join('thread_product_setups', 'thread_p_o_details.thread_product_setup_id', '=', 'thread_product_setups.id')
            ->select('thread_product_setups.id', 'thread_product_setups.name')
            ->where('purchase_order_master_id', $masterId)
            ->where('thread_p_o_details.status' , '!=', 'D')
            ->orderBy('thread_product_setups.name')
            ->groupBy('thread_p_o_details.thread_product_setup_id', 'thread_product_setups.id', 'thread_product_setups.name')
            ->get();
    }

    public static function getUniqueProductTotalPrice($masterId, $productId){
        $poDetails = DB::table('thread_p_o_details')
            ->select('thread_p_o_details.order_quantity', 'thread_p_o_details.total_price')
            ->where('purchase_order_master_id', $masterId)
            ->where('thread_p_o_details.thread_product_setup_id', $productId)
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

    public static function getUniqueProductTotalQty($masterId, $productId){
        $poDetails = DB::table('thread_p_o_details')
            ->select('thread_p_o_details.order_quantity', 'thread_p_o_details.total_price')
            ->where('purchase_order_master_id', $masterId)
            ->where('thread_p_o_details.thread_product_setup_id', $productId)
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

    public static function getTotalQuantity($masterId){
        $poDetails = DB::table('thread_p_o_details')
            ->select('thread_p_o_details.order_quantity', 'thread_p_o_details.total_price')
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
        $poDetails = DB::table('thread_p_o_details')
            ->select('thread_p_o_details.order_quantity', 'thread_p_o_details.total_price')
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
