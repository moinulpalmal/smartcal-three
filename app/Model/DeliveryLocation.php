<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class DeliveryLocation extends Model
{
    public static function getDeliveryLocationForSelectField(){
        return DB::table('delivery_locations')
            ->select('id', 'name')
            ->where('status', 'A')
            ->orderBy('name')
            ->get();
    }
}
