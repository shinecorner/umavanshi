<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\WaxWork;
use App\Model\WaxWithdrawal;

class WaxArchieve extends Model {

    protected $table = 'wax_archieve';
    public $timestamps = false;

    public static function getArchieveInfo($labour_id) {        
        $archieve_info = array();
        $labour = WaxLabour::find($labour_id);
        if ($labour) {
            $entries = WaxWork::query()->where('wax_labour_id', $labour_id)->get();
            $withdrawal_amount = WaxWithdrawal::fetchCurrentAmount($labour_id);
            $archieve_info['wax_labour_id'] = $labour_id;
            $archieve_info['labour_name'] = $labour->name;
            $archieve_info['withdrawal'] = $withdrawal_amount;
            $subtotal = 0;
            $total_pieces = 0;
            $num = 1;
            $num_total_entries = count($entries);
            $archieve_info['entries'] = array();
            
            foreach ($entries as $entry) {
                if($num == 1){
                    $archieve_info['archieve_start_date'] = $entry->created_at;
                }
                elseif($num == $num_total_entries){
                    $archieve_info['archieve_end_date'] = $entry->created_at;
                }
                $subtotal += $entry->total_price;
                $total_pieces += $entry->ordered_pieces;
                if ($entry->ordered_pieces) {                    
                    $archieve_info['entries'][$entry->id]['entry_id'] = $entry->id;                    
                    $archieve_info['entries'][$entry->id]['entry_date'] = $entry->entry_date;
                    $archieve_info['entries'][$entry->id]['ordered_pieces'] = $entry->ordered_pieces;
                    $archieve_info['entries'][$entry->id]['used_weight'] = $entry->used_weight;
                    $archieve_info['entries'][$entry->id]['unit_price'] = $entry->unit_price;
                    $archieve_info['entries'][$entry->id]['entry_total_prices'] = $entry->total_price;
                    $archieve_info['entries'][$entry->id]['given_wax_date'] = $entry->given_wax_date;
                    $archieve_info['entries'][$entry->id]['given_wax_weight'] = $entry->given_wax_weight;
                    $archieve_info['entries'][$entry->id]['remaining_weight'] = $entry->remaining_weight;
                    $archieve_info['entries'][$entry->id]['detail'] = $entry->detail;                    
                    $archieve_info['entries'][$entry->id]['created_at'] = $entry->created_at;
                    $archieve_info['entries'][$entry->id]['updated_at'] = $entry->updated_at;
                }
                $num++;
            }

            $archieve_info['subtotal'] = round_to_2dp($subtotal);
            $archieve_info['total_pieces'] = $total_pieces;
            $archieve_info['payable_exclude_withdrawal'] = round_to_2dp($subtotal);
            $archieve_info['payable_include_withdrawal'] = round_to_2dp($subtotal);

            if ($archieve_info['withdrawal']) {
                if ($archieve_info['withdrawal'] > $archieve_info['subtotal']) {
                    $calculated_total = (float) ($archieve_info['withdrawal'] - $archieve_info['subtotal']);
                } else {
                    $calculated_total = (float) ($archieve_info['subtotal'] - $archieve_info['withdrawal']);
                }
                $archieve_info['payable_include_withdrawal'] = round_to_2dp($calculated_total);
            }
        }        
        return $archieve_info;
    }

    public static function switchWithdrawalInvoice($labour_id, $include_withdrawal) {
        $archieve_info = array();
        $entries = WaxWork::query()->where('wax_labour_id', $labour_id)->get();
        $archieve_info['withdrawal'] = 0.00;
        if ($include_withdrawal) {
            $withdrawal = WaxWithdrawal::query()->where('wax_labour_id', $labour_id)->orderBy('id', 'desc')->first();
            $archieve_info['withdrawal'] = ($withdrawal) ? $withdrawal->last_amount : 0.00;
        }
        $subtotal = 0;        
        foreach ($entries as $entry) {
            $subtotal += $entry->total_price;            
        }

        $archieve_info['subtotal'] = round_to_2dp($subtotal);
        $archieve_info['total_payable'] = round_to_2dp($subtotal);

        if ($include_withdrawal && $archieve_info['withdrawal']) {
            if ($archieve_info['withdrawal'] > $archieve_info['subtotal']) {
                $calculated_total = (float) ($archieve_info['withdrawal'] - $archieve_info['subtotal']);
            } else {
                $calculated_total = (float) ($archieve_info['subtotal'] - $archieve_info['withdrawal']);
            }
            $archieve_info['total_payable'] = round_to_2dp($calculated_total);
        }

        return $archieve_info;
    }    
}
