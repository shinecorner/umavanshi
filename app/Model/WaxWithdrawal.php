<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class WaxWithdrawal extends Model
{
    protected $table   = 'wax_withdrawal';
    public static function fetchEntries($labour_id){
        $withdrawal_list = WaxWithdrawal::query()->where('wax_labour_id', $labour_id)->orderBy('id','desc')->get();
        return $withdrawal_list;
    }
    public static function fetchCurrentAmount($labour_id){
        $withdrawal = WaxWithdrawal::query()->where('wax_labour_id', $labour_id)->orderBy('id','desc')->first();
        $current_amount = 0;
        if ($withdrawal) {
            $current_amount = $withdrawal->last_amount;
        }        
        return $current_amount;
    }
    public static function createEntry($labour_id, $params){
        $withdrawal = NULL;
        $withdrawal_amount = (isset($params['withdrawal_amount']) && !empty($params['withdrawal_amount'])) ? $params['withdrawal_amount'] : 0;
        $settled_amount = (isset($params['settled_amount']) && !empty($params['settled_amount'])) ? $params['settled_amount'] : 0;
        $detail = (isset($params['detail']) && !empty($params['detail'])) ? $params['detail'] : NULL;
        if($withdrawal_amount || $settled_amount){
            $current_amount = WaxWithdrawal::fetchCurrentAmount($labour_id); 
            $withdrawal = new WaxWithdrawal;
            $withdrawal->wax_labour_id = $labour_id;
            $withdrawal->current_amount = $current_amount;
            if($withdrawal_amount){                
                $withdrawal->withdrawal_amount = $withdrawal_amount;
                $withdrawal->settled_amount = 0;
                $withdrawal->last_amount = ($current_amount + $withdrawal_amount);
            }
            elseif($settled_amount){
                $withdrawal->withdrawal_amount = 0;
                $withdrawal->settled_amount = $settled_amount;
                $withdrawal->last_amount = ($current_amount - $settled_amount);
            }
            if($detail){
                $withdrawal->detail = $detail;
            }            
            $withdrawal->save();            
        }
        return $withdrawal;
    }
}
