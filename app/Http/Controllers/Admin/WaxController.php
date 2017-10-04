<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\WaxLabour;
use App\Model\WaxWork;
use App\Model\WaxArchieve;
use App\Model\WaxArchieveBatch;
use App\Model\WaxWithdrawal;
use App\Model\WaxGivenLabour;
use App\Model\WaxDesignDetail;
use App\Model\WaxOrderForm;
use Carbon\Carbon;
use Validator;
use DB;

class WaxController extends Controller {

    private $batch_id = NULL;

    public function index() {
        $labours = WaxLabour::getLabourList();
        return view('admin.wax.index', array('labours' => $labours));
    }

    public function newLabour(Request $request) {
        return view('admin.wax.new_labour');
    }

    public function createLabour(Request $request) {
        $this->validate($request, [
            'name' => 'required',
        ]);

        $labour_entry = new WaxLabour;
        $labour_entry->name = $request->input('name');
        $labour_entry->save();
        return redirect()->route('wax_labour_list');
    }

    public function editLabour($labour_id, Request $request) {
        $entry = WaxLabour::find($labour_id);
        return view('admin.wax.edit_labour', ['entry' => $entry]);
    }

    public function updateLabour($labour_id, Request $request) {
        $this->validate($request, [
            'name' => 'required',
        ]);

        $labour_entry = WaxLabour::find($labour_id);
        $labour_entry->name = $request->input('name');
        $labour_entry->save();
        return redirect()->route('wax_labour_list');
    }

    public function deleteLabour($labour_id, Request $request) {
        // delete        
        $entry = WaxLabour::find($labour_id);
        $entry->delete();

        // redirect
        $request->session()->flash('alert-success', 'Successfully deleted entry');
        return redirect()->route('wax_labour_list');
    }

    public function labourWork($labour_id, Request $request) {
//        echo $locale = \App::getLocale();exit;
        $works = WaxWork::getLabourWork($labour_id);
        return view('admin.wax.labour-work', array('works' => $works, 'labour_id' => $labour_id));
    }

    public function newWorkEntry($labour_id, Request $request) {
        return view('admin.wax.new-work', array('labour_id' => $labour_id));
    }

    public function createWorkEntry($labour_id, Request $request) {
        $this->validate($request, [
            'entry_date' => 'required|date_format:d/m/Y',
            'ordered_pieces' => 'numeric',
            'used_weight' => 'numeric',
            'unit_price' => 'numeric',
            'detail' => 'required',
        ]);

        DB::transaction(function() use ($labour_id, $request) {
            $total_price = 0;
            $remaining_weight = 0;
            $used_weight = $request->input('used_weight');
            $ordered_pieces = $request->input('ordered_pieces');
            $unit_price = $request->input('unit_price');
            if (!empty($ordered_pieces) && !empty($unit_price)) {
                $total_price = $ordered_pieces * $unit_price;
            }

            $wax_entry = new WaxWork;
            $wax_entry->wax_labour_id = $labour_id;
            $entry_date_carbon = Carbon::createFromFormat('d/m/Y', $request->input('entry_date'));
            $wax_entry->entry_date = $entry_date_carbon->format('Y-m-d');
            $wax_entry->ordered_pieces = $request->input('ordered_pieces');
            $wax_entry->used_weight = $used_weight;
            $wax_entry->unit_price = $request->input('unit_price');
            $wax_entry->detail = $request->input('detail');
            $wax_entry->created_at = date("Y-m-d H:i:s");
            if ($total_price) {
                $wax_entry->total_price = $total_price;
            }
            $wax_entry->save();

            if (!empty($used_weight)) {
                $remaining_weight = WaxLabour::settleWaxWeight($labour_id, array('plus_weight' => 0, 'minus_weight' => $used_weight));
            }
            $wax_entry->remaining_weight = $remaining_weight;

            $wax_given_info = WaxGivenLabour::getWaxGivenInfo($labour_id);
            if ($wax_given_info) {
                $wax_entry->given_wax_date = $wax_given_info->given_date;
                $wax_entry->given_wax_weight = $wax_given_info->weight;
            }

            $wax_entry->save();
        });
        return redirect()->route('wax_work_list', ['labour_id' => $labour_id]);
    }

    public function editEntry($entry_id, Request $request) {
        $entry = WaxWork::find($entry_id);
        return view('admin.wax.edit-work', ['entry' => $entry]);
    }

    public function updateEntry($entry_id, Request $request) {
        $this->validate($request, [
            'entry_date' => 'required|date_format:d/m/Y',
            'ordered_pieces' => 'numeric',
            'used_weight' => 'numeric',
            'unit_price' => 'numeric',
            'detail' => 'required',
        ]);
        $wax_entry = WaxWork::find($entry_id);
        DB::transaction(function() use ($wax_entry, $request) {            
            $old_used_weight = $wax_entry->used_weight;
            $total_price = 0;
            $remaining_weight = 0;
            $used_weight = $request->input('used_weight');
            $ordered_pieces = $request->input('ordered_pieces');
            $unit_price = $request->input('unit_price');
            if (!empty($ordered_pieces) && !empty($unit_price)) {
                $total_price = $ordered_pieces * $unit_price;
            }

            $entry_date_carbon = Carbon::createFromFormat('d/m/Y', $request->input('entry_date'));
            $wax_entry->entry_date = $entry_date_carbon->format('Y-m-d');
            $wax_entry->ordered_pieces = $request->input('ordered_pieces');
            $wax_entry->unit_price = $request->input('unit_price');
            $wax_entry->detail = $request->input('detail');
            $wax_entry->updated_at = date("Y-m-d H:i:s");
            if ($total_price) {
                $wax_entry->total_price = $total_price;
            }
            $wax_entry->save();
            WaxWork::adjustWeightEntry($wax_entry->id, $used_weight, array('action' => 'update'));
            if (!empty($used_weight)) {
                $remaining_weight = WaxLabour::settleWaxWeight($wax_entry->wax_labour_id, array('plus_weight' => $old_used_weight, 'minus_weight' => $used_weight));
            }
        });

        return redirect()->route('wax_work_list', ['labour_id' => $wax_entry->wax_labour_id]);
    }

    public function deleteEntry($entry_id, Request $request) {
        $entry = WaxWork::find($entry_id);
        $labour_id = $entry->wax_labour_id;
        DB::transaction(function() use ($entry, $labour_id, $request) {            
            $used_weight = $entry->used_weight;            
            WaxWork::adjustWeightEntry($entry->id, '', array('action' => 'delete'));
            $entry->delete();
            if (!empty($used_weight)) {
                WaxLabour::settleWaxWeight($labour_id, array('plus_weight' => $used_weight, 'minus_weight' => 0));
            }
            // redirect
            $request->session()->flash('alert-success', 'Successfully deleted entry');
        });


        return redirect()->route('wax_work_list', ['labour_id' => $labour_id]);
    }

    public function archieveEntry($labour_id, Request $request) {
        $archieve_info = WaxArchieve::getArchieveInfo($labour_id);
        return view('admin.wax.archieve_info', array('archieve_info' => $archieve_info));
    }

    public function handleWithdrawal($labour_id, Request $request) {
        $include_withdrawal = $request->get('include_withdrawal');
        $archieve_info = WaxArchieve::switchWithdrawalInvoice($labour_id, $include_withdrawal);
        echo json_encode($archieve_info);
        exit;
    }

    public function handleArchieveEntry($labour_id, Request $request) {
        $this->validate($request, ['captcha' => 'required|captcha']);
        $include_withdrawal = $request->input('chk_include_withdrawal');
        $archieve_info = WaxArchieve::getArchieveInfo($labour_id);
//        print_r($archieve_info);exit;
        $batch_id = NULL;
        DB::transaction(function() use ($labour_id, $archieve_info, $include_withdrawal) {
            global $batch_id;
            $archieve_batch = new WaxArchieveBatch;
            $archieve_batch->wax_labour_id = $labour_id;
            $archieve_batch->archieve_start_date = $archieve_info['archieve_start_date']->toDateTimeString();
            $archieve_batch->archieve_end_date = $archieve_info['archieve_end_date']->toDateTimeString();
            $archieve_batch->total_pieces = $archieve_info['total_pieces'];
            $archieve_batch->subtotal = $archieve_info['subtotal'];
            $current_withdrawal = WaxWithdrawal::fetchCurrentAmount($labour_id);
            $archieve_batch->current_withdrawal = $current_withdrawal;
            if (empty($include_withdrawal)) {
                $archieve_batch->apply_withdrawal = 0;
                $archieve_batch->settled_withdrawal = 0;
                $archieve_batch->total_paid = $archieve_info['payable_exclude_withdrawal'];
                $archieve_batch->remaining_withdrawal = $current_withdrawal;
            } else {
                $archieve_batch->apply_withdrawal = 1;
                if ($archieve_info['withdrawal'] > $archieve_info['payable_exclude_withdrawal']) {
                    $archieve_batch->settled_withdrawal = $archieve_info['payable_exclude_withdrawal'];
                    $calculated_amount = (float) ($current_withdrawal - $archieve_info['payable_exclude_withdrawal']);
                    $archieve_batch->total_paid = 0;
                    $archieve_batch->remaining_withdrawal = $calculated_amount;
                } else {
                    $archieve_batch->settled_withdrawal = $current_withdrawal;
                    $calculated_amount = (float) ($archieve_info['payable_exclude_withdrawal'] - $current_withdrawal);
                    $archieve_batch->total_paid = $calculated_amount;
                    $archieve_batch->remaining_withdrawal = 0;
                }
            }
            $detail_json_arr = array();
            foreach ($archieve_info['entries'] as $entry) {
                $detail_json_arr['entry_ids'][] = $entry['entry_id'];
            }
            $detail_json = json_encode($detail_json_arr);
            $archieve_batch->detail_json = $detail_json;
            $archieve_batch->created_at = date("Y-m-d H:i:s");
            $archieve_batch->save();

            foreach ($archieve_info['entries'] as $entry) {
                $archieve_entry = new WaxArchieve;
                $archieve_entry->batch_id = $archieve_batch->id;
                $archieve_entry->wax_work_id = $entry['entry_id'];
                $archieve_entry->wax_labour_id = $archieve_info['wax_labour_id'];
                $archieve_entry->entry_date = $entry['entry_date'];
                $archieve_entry->ordered_pieces = $entry['ordered_pieces'];
                $archieve_entry->used_weight = $entry['used_weight'];
                $archieve_entry->unit_price = $entry['unit_price'];                
                $archieve_entry->total_price = $entry['entry_total_prices'];
                $archieve_entry->given_wax_date = $entry['given_wax_date'];
                $archieve_entry->given_wax_weight = $entry['given_wax_weight'];
                $archieve_entry->remaining_weight = $entry['remaining_weight'];
                $archieve_entry->detail = $entry['detail'];                
                $archieve_entry->entry_created_at = $entry['created_at']->toDateTimeString();
                $archieve_entry->entry_updated_at = $entry['updated_at']->toDateTimeString();
                $archieve_entry->archieved_at = date("Y-m-d H:i:s");
                $archieve_entry->save();
            }
            if (!empty($include_withdrawal) && !empty($archieve_info['withdrawal'])) {
                if ($archieve_info['withdrawal'] > $archieve_info['payable_exclude_withdrawal']) {
                    $settled_withdrawal_amount = $archieve_info['payable_exclude_withdrawal'];
                } else {
                    $settled_withdrawal_amount = $archieve_info['withdrawal'];
                }
                $pass_array = array(
                    'withdrawal_amount' => 0,
                    'settled_amount' => $settled_withdrawal_amount,
                    'detail' => 'ArchieveBatch#' . $archieve_batch->id
                );
                WaxWithdrawal::createEntry($labour_id, $pass_array);
            }
            if (isset($detail_json_arr['entry_ids']) && !empty($detail_json_arr['entry_ids'])) {
                DB::table('wax_work')->whereIn('id', $detail_json_arr['entry_ids'])->delete();
            }
            $this->batch_id = $archieve_batch->id;
        });
        if ($this->batch_id) {
            return redirect()->route('wax_fetch_archieve_entry', ['batch_id' => $this->batch_id]);
        } else {
            return view('admin.wax.archieve_info', array('archieve_info' => $archieve_info));
        }
    }

    public function listArchieveBatch($labour_id, Request $request) {
        $list_batch = WaxArchieveBatch::listArchieveBatch($labour_id);
        return view('admin.wax.list_batch', array('list_batch' => $list_batch));
    }

    public function fetchArchieveEntry($batch_id, Request $request) {
        $batch_info = WaxArchieveBatch::fetchArchieveEntry($batch_id);
        return view('admin.wax.archieve_batch_info', array('batch_info' => $batch_info));
    }

    public function listWithdrawal($labour_id, Request $request) {
        $withdrawal_list = WaxWithdrawal::fetchEntries($labour_id);
        return view('admin.wax.withdrawal_list', array('withdrawal_list' => $withdrawal_list, 'labour_id' => $labour_id));
    }

    public function newWithdrawal($labour_id, Request $request) {
        $current_amount = WaxWithdrawal::fetchCurrentAmount($labour_id);
        return view('admin.wax.new-withdrawal', array('labour_id' => $labour_id, 'current_amount' => $current_amount));
    }

    public function createWithdrawal($labour_id, Request $request) {
        $this->validate($request, [
            'withdrawal_amount' => 'numeric',
            'settled_amount' => 'numeric',
        ]);

        $pass_array = array(
            'withdrawal_amount' => $request->input('withdrawal_amount'),
            'settled_amount' => $request->input('settled_amount'),
            'detail' => $request->input('detail')
        );
        WaxWithdrawal::createEntry($labour_id, $pass_array);
        return redirect()->route('wax_withdrawal_list', ['labour_id' => $labour_id]);
    }

    public function listWaxGiven($labour_id, Request $request) {
        $wax_given_list = WaxGivenLabour::fetchEntries($labour_id);
        return view('admin.wax.wax_given_list', array('wax_given_list' => $wax_given_list, 'labour_id' => $labour_id));
    }

    public function newWaxGiven($labour_id, Request $request) {
        return view('admin.wax.new_wax_given', array('labour_id' => $labour_id));
    }

    public function createWaxGiven($labour_id, Request $request) {
        $this->validate($request, [
            'weight' => 'numeric',
            'given_date' => 'required|date_format:d/m/Y',
        ]);
        $given_weight = $request->input('weight');
        $given_weight_entry = new WaxGivenLabour;
        $given_weight_entry->wax_labour_id = $labour_id;

        $given_date_carbon = Carbon::createFromFormat('d/m/Y', $request->input('given_date'));
        $given_weight_entry->given_date = $given_date_carbon->format('Y-m-d');

        $given_weight_entry->weight = $request->input('weight');
        $given_weight_entry->save();
        if ($given_weight) {
            WaxLabour::settleWaxWeight($labour_id, array('plus_weight' => $given_weight, 'minus_weight' => 0));
        }
        return redirect()->route('wax_given_weight_list', ['labour_id' => $labour_id]);
    }

    public function listWaxDesign(Request $request) {
        $wax_design_list = WaxDesignDetail::fetchEntries();
        return view('admin.wax.wax_design_list', array('wax_design_list' => $wax_design_list));
    }

    public function newWaxDeign(Request $request) {
        return view('admin.wax.new_design');
    }

    public function createWaxDesign(Request $request) {
        $this->validate($request, [
            'name' => 'required',
            'pieces' => 'required|numeric',
            'weight' => 'required|numeric',
        ]);

        $design_entry = new WaxDesignDetail;
        $design_entry->weight = $request->input('weight');
        $design_entry->name = $request->input('name');
        $design_entry->pieces = $request->input('pieces');
        $design_entry->save();
        return redirect()->route('wax-design-list');
    }

    public function editDesign($entry_id, Request $request) {
        $entry = WaxDesignDetail::find($entry_id);
        return view('admin.wax.edit_design', ['entry' => $entry]);
    }

    public function updateDesign($entry_id, Request $request) {
        $this->validate($request, [
            'name' => 'required',
            'pieces' => 'required|numeric',
            'weight' => 'required|numeric',
        ]);

        $entry = WaxDesignDetail::find($entry_id);
        $entry->weight = $request->input('weight');
        $entry->name = $request->input('name');
        $entry->pieces = $request->input('pieces');
        $entry->save();
        return redirect()->route('wax-design-list');
    }

    public function deleteDesign($entry_id, Request $request) {
        // delete        
        $entry = WaxDesignDetail::find($entry_id);
        $entry->delete();

        // redirect
        $request->session()->flash('alert-success', 'Successfully deleted entry');
        return redirect()->route('wax-design-list');
    }

    public function listOrderForm($labour_id, Request $request) {
        $order_form_list = WaxOrderForm::fetchEntries($labour_id);
        return view('admin.wax.order_form_list', array('order_form_list' => $order_form_list, 'labour_id' => $labour_id));
    }

    public function newOrderForm($labour_id, Request $request) {
        return view('admin.wax.new_order_form', array('labour_id' => $labour_id));
    }

    public function createOrderForm($labour_id, Request $request) {
        $this->validate($request, [
            'entry_date' => 'required|date_format:d/m/Y',
            'ordered_pieces' => 'numeric',
            'detail' => 'required',
        ]);

        $order_form_entry = new WaxOrderForm;
        $order_form_entry->wax_labour_id = $labour_id;

        $entry_date_carbon = Carbon::createFromFormat('d/m/Y', $request->input('entry_date'));
        $order_form_entry->entry_date = $entry_date_carbon->format('Y-m-d');

        $order_form_entry->ordered_pieces = $request->input('ordered_pieces');
        $order_form_entry->detail = $request->input('detail');
        $order_form_entry->save();

        return redirect()->route('wax_order_form_list', ['labour_id' => $labour_id]);
    }

    public function showComplete($entry_id, Request $request) {
        $entry = WaxWork::find($entry_id);
        return view('admin.wax.complete-work', ['entry' => $entry]);
    }

    public function doComplete($entry_id, Request $request) {
        $this->validate($request, [
            'return_date' => 'required|date_format:d/m/Y',
            'return_pieces' => 'numeric',
            'return_weight' => 'numeric',
            'remaining_weight' => 'numeric',
            'remaining_weight_status' => 'required',
            'total_price' => 'numeric',
            'detail' => 'required',
        ]);



        $wax_entry = WaxWork::find($entry_id);
        $return_date_carbon = Carbon::createFromFormat('d/m/Y', $request->input('return_date'));
        $wax_entry->return_date = $return_date_carbon->format('Y-m-d');
        $wax_entry->return_pieces = $request->input('return_pieces');
        $wax_entry->return_weight = $request->input('return_weight');
        $wax_entry->remaining_weight = $request->input('remaining_weight');
        $wax_entry->remaining_weight_status = $request->input('remaining_weight_status');
        $wax_entry->total_price = $request->input('total_price');
        $wax_entry->detail = $request->input('detail');
        $wax_entry->is_completed = '1';
        $wax_entry->updated_at = date("Y-m-d H:i:s");
        $wax_entry->save();

        if ($request->input('remaining_weight_status') == 'Returned To Labour') {
            $labour = WaxLabour::find($wax_entry->wax_labour_id);
            $labour->wax_weight_stock = ($labour->wax_weight_stock + $request->input('remaining_weight'));
            $labour->save();
        }

        return redirect()->route('wax_work_list', ['labour_id' => $wax_entry->wax_labour_id]);
    }

}
