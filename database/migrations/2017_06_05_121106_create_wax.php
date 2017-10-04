<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWax extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        if (!Schema::hasTable('wax_labour')) {
            Schema::create('wax_labour', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name', 100);
                $table->boolean('is_active')->default(1);
                $table->decimal('wax_weight_stock', 10, 2)->default(0.0);
                $table->timestamps();
            });
        }
        if (!Schema::hasTable('wax_work')) {
            Schema::create('wax_work', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('wax_labour_id')->unsigned();
                
                $table->date('entry_date')->nullable();
                $table->integer('ordered_pieces')->nullable();                
                $table->decimal('used_weight', 10, 2)->nullable();                
                
                $table->decimal('unit_price', 10, 2)->nullable();
                $table->decimal('total_price', 10, 2)->nullable();
                $table->date('given_wax_date')->nullable();
                $table->decimal('given_wax_weight', 10, 2)->nullable();
                $table->decimal('remaining_weight', 10, 2)->nullable();
                $table->text('detail')->nullable();
                
                $table->timestamps();

                $table->engine = 'InnoDB';
            });
        }
        if (!Schema::hasTable('wax_design_detail')) {
            Schema::create('wax_design_detail', function (Blueprint $table) {
                $table->increments('id');                
                $table->string('name', 50);
                $table->integer('pieces')->nullable();                
                $table->decimal('weight', 10, 2)->nullable();                                
                
                $table->engine = 'InnoDB';
            });
        }
        if (!Schema::hasTable('wax_given_labour')) {
            Schema::create('wax_given_labour', function (Blueprint $table) {
                $table->increments('id');             
                $table->integer('wax_labour_id')->unsigned();
                $table->date('given_date')->nullable();                
                $table->decimal('weight', 10, 2)->nullable();                                
                $table->timestamps();
                $table->engine = 'InnoDB';
            });
        }
        if (!Schema::hasTable('wax_archieve')) {
            Schema::create('wax_archieve', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('batch_id')->unsigned();
                $table->integer('wax_work_id')->unsigned();
                $table->integer('wax_labour_id')->unsigned();                
                
                $table->date('entry_date')->nullable();
                $table->integer('ordered_pieces')->nullable();                
                $table->decimal('used_weight', 10, 2)->nullable();                                
                $table->decimal('unit_price', 10, 2)->nullable();
                $table->decimal('total_price', 10, 2)->nullable();
                $table->date('given_wax_date')->nullable();
                $table->decimal('given_wax_weight', 10, 2)->nullable();
                $table->decimal('remaining_weight', 10, 2)->nullable();
                $table->text('detail')->nullable();
                $table->dateTime('entry_created_at');
                $table->dateTime('entry_updated_at');
                $table->dateTime('archieved_at');

                $table->engine = 'InnoDB';
            });
        }
        
        if (!Schema::hasTable('wax_archieve_batch')) {
            Schema::create('wax_archieve_batch', function (Blueprint $table) {
                $table->increments('id');                                
                $table->integer('wax_labour_id')->unsigned();
                $table->date('archieve_start_date');
                $table->date('archieve_end_date');
                $table->integer('total_pieces')->nullable();
                $table->decimal('subtotal', 10, 2)->nullable();
                $table->boolean('apply_withdrawal')->default(0);
                $table->decimal('current_withdrawal', 10, 2)->nullable();
                $table->decimal('settled_withdrawal', 10, 2)->nullable();
                $table->decimal('total_paid', 10, 2)->nullable();                
                $table->decimal('remaining_withdrawal', 10, 2)->nullable();
                $table->text('detail_json');
                $table->timestamps();
                $table->engine = 'InnoDB';
            });
        }
        
         if (!Schema::hasTable('wax_withdrawal')) {
            Schema::create('wax_withdrawal', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('wax_labour_id')->unsigned();
                $table->decimal('current_amount', 10, 2)->nullable();
                $table->decimal('withdrawal_amount', 10, 2)->nullable();
                $table->decimal('settled_amount', 10, 2)->nullable();
                $table->decimal('last_amount', 10, 2)->nullable();                
                $table->text('detail')->nullable();
                $table->timestamps();
                $table->engine = 'InnoDB';
            });
        }
        if (!Schema::hasTable('wax_order_form')) {
            Schema::create('wax_order_form', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('wax_labour_id')->unsigned();
                $table->date('entry_date')->nullable();
                $table->integer('ordered_pieces')->nullable();                
                $table->text('detail')->nullable();
                $table->timestamps();
                $table->engine = 'InnoDB';
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        //
    }

}
