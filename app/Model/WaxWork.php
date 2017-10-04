<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class WaxWork extends Model {

    protected $table = 'wax_work';

    public static function getLabourWork($labour_id) {
        return WaxWork::query()->where('wax_labour_id', $labour_id)->orderBy('id')->get()->toArray();
    }

    public static function adjustWeightEntry($entry_id, $new_weight, $params = array()) {
        $action = (isset($params['action']) && !empty($params['action'])) ? $params['action'] : NULL;
        if ($action == 'update') {
            $wax_entry = WaxWork::find($entry_id);
            $old_used_weight = $wax_entry->used_weight;
            $old_remaining = $wax_entry->remaining_weight;            
            $difference = $old_used_weight - $new_weight;
            $wax_entry->remaining_weight = ($wax_entry->remaining_weight + $difference);
            $wax_entry->used_weight = $new_weight;
            $wax_entry->save();
            $labour_id = $wax_entry->wax_labour_id;
            $work_entries = WaxWork::where([
                        ['wax_labour_id', '=', $labour_id],
                        ['id', '>', $entry_id],
                    ])->orderBy('id')->get();
            foreach ($work_entries as $entry) {                                
                $entry->remaining_weight = ($entry->remaining_weight + $difference);
                $entry->save();
            }
        }
        if ($action == 'delete') {
            $wax_entry = WaxWork::find($entry_id);
            $delete_used_weight = $wax_entry->used_weight;
            $labour_id = $wax_entry->wax_labour_id;
            $work_entries = WaxWork::where([
                        ['wax_labour_id', '=', $labour_id],
                        ['id', '>', $entry_id],
                    ])->orderBy('id')->get();
            foreach ($work_entries as $entry) {
                $entry_used_weight = $entry->used_weight;
                $entry_remaining_weight = $entry->remaining_weight;
                $new_remaining = ($entry_remaining_weight + $delete_used_weight);
                $entry->remaining_weight = $new_remaining;
                $entry->save();
            }
        }
    }

}
