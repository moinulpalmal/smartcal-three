<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Buyer extends Model
{
    public static function getBuyersForSelectField(){
        return DB::table('buyers')
            ->select('id', 'name')
            ->where('status', 'A')
            ->orderBy('name')
            ->get();
    }
}
