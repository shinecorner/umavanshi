<?php

use Illuminate\Database\Seeder;

class WaxTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $wax_labour_id_1 = DB::table('wax_labour')->insertGetId([
            'name' => 'Babubhai',
            'wax_weight_stock' => 18000
        ]);

        $wax_labour_id_2 = DB::table('wax_labour')->insertGetId([
            'name' => 'Dineshbhai',
            'wax_weight_stock' => 18000
        ]);
        $wax_labour_id_3 = DB::table('wax_labour')->insertGetId([
            'name' => 'Rahulbhai',
            'wax_weight_stock' => 18000
        ]);

        DB::table('wax_work')->insert([
            'wax_labour_id' => $wax_labour_id_1,
            'entry_date' => date("Y-m-d"),            
            'ordered_pieces' => 1500,
            'used_weight' => 2000.00,
            'unit_price' => 0.125,
            'total_price' => (1500 * 0.125),
            'given_wax_date' => date("Y-m-d", strtotime('-25 days')),
            'given_wax_weight' => 20000,
            'remaining_weight' => 18000.00,
            'detail' => 'Ramola',            
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s", strtotime('tomorrow')),
        ]);
        DB::table('wax_work')->insert([
            'wax_labour_id' => $wax_labour_id_2,
            'entry_date' => date("Y-m-d"),            
            'ordered_pieces' => 1500,
            'used_weight' => 2000.00,
            'unit_price' => 0.125,
            'total_price' => (1500 * 0.125),
            'given_wax_date' => date("Y-m-d", strtotime('-25 days')),
            'given_wax_weight' => 20000,
            'remaining_weight' => 18000.00,
            'detail' => 'Ramola',            
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s", strtotime('tomorrow')),
        ]);

        DB::table('wax_work')->insert([
            'wax_labour_id' => $wax_labour_id_3,
            'entry_date' => date("Y-m-d"),            
            'ordered_pieces' => 1500,
            'used_weight' => 2000.00,
            'unit_price' => 0.125,
            'total_price' => (1500 * 0.125),
            'given_wax_date' => date("Y-m-d", strtotime('-25 days')),
            'given_wax_weight' => 20000,
            'remaining_weight' => 18000.00,
            'detail' => 'Ramola',            
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s", strtotime('tomorrow')),
        ]);
//        DB::table('wax_work')->insert([
//            
//        ]);
//        DB::table('wax_work')->insert([
//            
//        ]);

        DB::table('wax_given_labour')->insert([
            'wax_labour_id' => $wax_labour_id_1,
            'given_date' => date("Y-m-d", strtotime('-25 days')),
            'weight' => 20000.00,            
            'created_at' => date("Y-m-d H:i:s", strtotime('-25 days')),
            'updated_at' => date("Y-m-d H:i:s", strtotime('-25 days')),
        ]);
        
        DB::table('wax_given_labour')->insert([
            'wax_labour_id' => $wax_labour_id_2,
            'given_date' => date("Y-m-d", strtotime('-25 days')),
            'weight' => 20000.00,            
            'created_at' => date("Y-m-d H:i:s", strtotime('-25 days')),
            'updated_at' => date("Y-m-d H:i:s", strtotime('-25 days')),
        ]);
        
        DB::table('wax_given_labour')->insert([
            'wax_labour_id' => $wax_labour_id_3,
            'given_date' => date("Y-m-d", strtotime('-25 days')),
            'weight' => 20000.00,            
            'created_at' => date("Y-m-d H:i:s", strtotime('-25 days')),
            'updated_at' => date("Y-m-d H:i:s", strtotime('-25 days')),
        ]);
        
        DB::table('wax_withdrawal')->insert([
            'wax_labour_id' => $wax_labour_id_1,
            'current_amount' => 0,
            'withdrawal_amount' => 3000,
            'settled_amount' => 0,
            'last_amount' => 3000,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ]);

        DB::table('wax_withdrawal')->insert([
            'wax_labour_id' => $wax_labour_id_2,
            'current_amount' => 0,
            'withdrawal_amount' => 1000,
            'settled_amount' => 0,
            'last_amount' => 1000,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ]);
    }

}
