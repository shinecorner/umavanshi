<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class WaxLabour extends Model
{
    protected $table   = 'wax_labour';
    public static function getLabourList(){
        return WaxLabour::query()->where('is_active',1)->get()->toArray();
    }
    public static function settleWaxWeight($labour_id,$params){
        $labour = WaxLabour::find($labour_id);
        $plus_weight = (isset($params['plus_weight']) && !empty($params['plus_weight'])) ? $params['plus_weight'] : 0;
        $minus_weight = (isset($params['minus_weight']) && !empty($params['minus_weight'])) ? $params['minus_weight'] : 0;
        if($labour){
            if($plus_weight){
                $current_weight = (float) $labour->wax_weight_stock;
                $labour->wax_weight_stock = $current_weight + $plus_weight;
                $labour->save();
            }
            if($minus_weight){
                $current_weight = (float) $labour->wax_weight_stock;
                $labour->wax_weight_stock = $current_weight - $minus_weight;
                $labour->save();
            }
            return $labour->wax_weight_stock;
        }
    }
}
