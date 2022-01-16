<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class QCStickerPODetail extends Model
{
    public static function getElasticPODetails($masterId){
        return DB::table('q_c_sticker_p_o_details')
            ->where('purchase_order_master_id', $masterId)
            ->where('status' , '!=', 'D')
            ->get();
    }

    public static function getUniqueProducts($masterId){

        return DB::table('q_c_sticker_p_o_details')
            ->join('q_c_sticker_product_setups', 'q_c_sticker_p_o_details.q_c_sticker_product_setup_id', '=', 'q_c_sticker_product_setups.id')
            ->select('q_c_sticker_product_setups.id', 'q_c_sticker_product_setups.name')
            ->where('purchase_order_master_id', $masterId)
            ->where('q_c_sticker_p_o_details.status' , '!=', 'D')
            ->orderBy('q_c_sticker_product_setups.name')
            ->groupBy('q_c_sticker_p_o_details.q_c_sticker_product_setup_id', 'q_c_sticker_product_setups.id', 'q_c_sticker_product_setups.name')
            ->get();

    }

    public static function getTotalQuantity($masterId){
        $poDetails = DB::table('q_c_sticker_p_o_details')
            ->select('q_c_sticker_p_o_details.order_quantity', 'q_c_sticker_p_o_details.total_price')
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
        $poDetails = DB::table('q_c_sticker_p_o_details')
            ->select('q_c_sticker_p_o_details.order_quantity', 'q_c_sticker_p_o_details.total_price')
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
