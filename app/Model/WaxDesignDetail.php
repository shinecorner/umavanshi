<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class WaxDesignDetail extends Model {

    protected $table = 'wax_design_detail';
    public $timestamps = false;
    public static function fetchEntries() {
        $design_list = WaxDesignDetail::query()->orderBy('id', 'desc')->get();
        return $design_list;
    }

}
