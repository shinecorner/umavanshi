<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCasting extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        if (!Schema::hasTable('casting_labour')) {
            Schema::create('casting_labour', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name', 100);
                $table->boolean('is_active')->default(1);                
                $table->timestamps();
            });
        }
        if (!Schema::hasTable('casting_work')) {
            Schema::create('casting_work', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('casting_labour_id')->unsigned();
                
                $table->date('given_date')->nullable();
                $table->integer('given_wax_pieces')->nullable();
                $table->decimal('given_wax_weight', 10, 2)->nullable();                
                
                $table->date('return_date')->nullable();
                $table->decimal('return_weight', 10, 2)->nullable();
                $table->decimal('unit_price', 10, 2)->nullable();
                $table->decimal('total_price', 10, 2)->nullable();                
                $table->text('detail')->nullable();
                
                $table->boolean('is_completed');
                $table->timestamps();

                $table->engine = 'InnoDB';
            });
        }
        
        if (!Schema::hasTable('casting_metal_given')) {
            Schema::create('casting_metal_given', function (Blueprint $table) {
                $table->increments('id');             
                $table->integer('casting_labour_id')->unsigned();
                $table->date('given_date')->nullable();                
                $table->decimal('metal_weight', 10, 2)->nullable();
                $table->text('detail')->nullable();
                $table->decimal('unit_price', 10, 2)->nullable();
                $table->decimal('total_price', 10, 2)->nullable();
                $table->timestamps();
                $table->engine = 'InnoDB';
            });
        }
        if (!Schema::hasTable('casting_archieve')) {
            Schema::create('casting_archieve', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('batch_id')->unsigned();
                $table->integer('casting_work_id')->unsigned();
                $table->integer('casting_labour_id')->unsigned();
                
                $table->date('given_date')->nullable();
                $table->integer('given_wax_pieces')->nullable();
                $table->decimal('given_wax_weight', 10, 2)->nullable();                
                
                $table->date('return_date')->nullable();
                $table->decimal('return_weight', 10, 2)->nullable();
                $table->decimal('unit_price', 10, 2)->nullable();
                $table->decimal('total_price', 10, 2)->nullable();                
                $table->text('detail')->nullable();
                
                $table->boolean('is_completed');
                
                
                $table->dateTime('entry_created_at');
                $table->dateTime('entry_updated_at');
                $table->dateTime('archieved_at');

                $table->engine = 'InnoDB';
            });
        }
        
        if (!Schema::hasTable('casting_archieve_batch')) {
            Schema::create('casting_archieve_batch', function (Blueprint $table) {
                $table->increments('id');                                
                $table->integer('casting_labour_id')->unsigned();
                $table->date('archieve_start_date');
                $table->date('archieve_end_date');
                
                
                
                $table->decimal('casting_weight', 10, 2)->nullable();
                $table->decimal('casting_weight_unit_price', 10, 2)->nullable();
                $table->decimal('casting_weight_total_price', 10, 2)->nullable();
                
                $table->integer('wax_pieces')->nullable();
                $table->decimal('wax_pieces_labour_unit_price', 10, 2)->nullable();
                $table->decimal('wax_pieces_labour_total_price', 10, 2)->nullable();
                
                $table->decimal('wax_weight', 10, 2)->nullable();
                $table->decimal('wax_weight_unit_price', 10, 2)->nullable();
                $table->decimal('wax_weight_total_price', 10, 2)->nullable();
                
                $table->decimal('matel_weight', 10, 2)->nullable();
                $table->decimal('matel_weight_unit_price', 10, 2)->nullable();
                $table->decimal('matel_weight_total_price', 10, 2)->nullable();
                                
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
        
         if (!Schema::hasTable('casting_withdrawal')) {
            Schema::create('casting_withdrawal', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('casting_labour_id')->unsigned();
                $table->decimal('current_amount', 10, 2)->nullable();
                $table->decimal('withdrawal_amount', 10, 2)->nullable();
                $table->decimal('settled_amount', 10, 2)->nullable();
                $table->decimal('last_amount', 10, 2)->nullable();                
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
