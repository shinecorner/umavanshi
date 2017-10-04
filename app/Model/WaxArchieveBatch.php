<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
class WaxArchieveBatch extends Model {

    protected $table = 'wax_archieve_batch';

    public static function fetchArchieveEntry($batch_id) {
        $batch_info = array();
        $batch = WaxArchieveBatch::find($batch_id);
        if ($batch) {
            $labour = WaxLabour::find($batch->wax_labour_id);
            $entries = WaxArchieve::query()->where('batch_id', $batch->id)->get();
            $batch_info['wax_labour_id'] = $labour->id;
            $batch_info['labour_name'] = $labour->name;
            $batch_info['batch_id'] = $batch->id;
            $subtotal = 0;
            $total_pieces = 0;
            $batch_info['archieve_date'] = $batch->created_at;
            $batch_info['archieve_start_date'] = $batch->archieve_start_date;
            $batch_info['archieve_end_date'] = $batch->archieve_end_date;
            $batch_info['entries'] = array();
            foreach ($entries as $entry) {                
                if ($entry->ordered_pieces) {
                    $batch_info['entries'][$entry->id]['entry_id'] = $entry->id;                    
                    $batch_info['entries'][$entry->id]['wax_work_id'] = $entry->wax_work_id;                    
                    $batch_info['entries'][$entry->id]['entry_date'] = $entry->entry_date;
                    $batch_info['entries'][$entry->id]['ordered_pieces'] = $entry->ordered_pieces;
                    $batch_info['entries'][$entry->id]['used_weight'] = $entry->used_weight;
                    $batch_info['entries'][$entry->id]['unit_price'] = $entry->unit_price;
                    $batch_info['entries'][$entry->id]['entry_total_prices'] = $entry->total_price;
                    $batch_info['entries'][$entry->id]['given_wax_date'] = $entry->given_wax_date;
                    $batch_info['entries'][$entry->id]['given_wax_weight'] = $entry->given_wax_weight;
                    $batch_info['entries'][$entry->id]['remaining_weight'] = $entry->remaining_weight;
                    $batch_info['entries'][$entry->id]['detail'] = $entry->detail;                    
                    $batch_info['entries'][$entry->id]['created_at'] = $entry->entry_created_at;
                    $batch_info['entries'][$entry->id]['updated_at'] = $entry->entry_updated_at;
                }
            }

            $batch_info['subtotal'] = round_to_2dp($batch->subtotal);
            $batch_info['total_pieces'] = ($batch->total_pieces);
            $batch_info['apply_withdrawal'] = ($batch->apply_withdrawal);            
            $batch_info['current_withdrawal'] = round_to_2dp($batch->current_withdrawal);
            $batch_info['settled_withdrawal'] = round_to_2dp($batch->settled_withdrawal);
            $batch_info['total_paid'] = round_to_2dp($batch->total_paid);
            $batch_info['remaining_withdrawal'] = round_to_2dp($batch->remaining_withdrawal);
        }
        
        return $batch_info;
    }
    public static function listArchieveBatch($labour_id) {
        return $batch_list = WaxArchieveBatch::query()->where('wax_labour_id', $labour_id)->get();
    }
}
