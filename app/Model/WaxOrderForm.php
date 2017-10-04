<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class WaxOrderForm extends Model {

    protected $table = 'wax_order_form';

    public static function fetchEntries($labour_id) {
        $order_form_list = WaxOrderForm::query()->where('wax_labour_id', $labour_id)->orderBy('id', 'desc')->get();
        return $order_form_list;
    }

}
