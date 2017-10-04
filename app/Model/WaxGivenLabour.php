<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class WaxGivenLabour extends Model {

    protected $table = 'wax_given_labour';

    public static function getWaxGivenInfo($labour_id) {
        $last_wax_given_entry = WaxGivenLabour::query()->where('wax_labour_id', $labour_id)->orderBy('id', 'desc')->first();
        return $last_wax_given_entry;
    }

    public static function fetchEntries($labour_id) {
        $wax_given_list = WaxGivenLabour::query()->where('wax_labour_id', $labour_id)->orderBy('id', 'desc')->get();
        return $wax_given_list;
    }

}
