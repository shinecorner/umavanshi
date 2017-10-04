<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        if (!Schema::hasTable('users')) {
            Schema::create('users', function (Blueprint $table) {
                $table->increments('id');
                $table->string('username');
                $table->string('email');
                $table->string('password');
                $table->string('first_name')->nullable();
                $table->string('last_name')->nullable();
                $table->timestamps();

                $table->engine = 'InnoDB';
                $table->unique('username');
                $table->unique('email');
            });
        }

        if (!Schema::hasTable('roles')) {
            Schema::create('roles', function (Blueprint $table) {
                $table->increments('id');
                $table->string('slug');
                $table->string('name');
                $table->text('permissions')->nullable();
                $table->timestamps();

                $table->engine = 'InnoDB';
                $table->unique('slug');
            });
        }


        if (!Schema::hasTable('role_users')) {
            Schema::create('role_users', function (Blueprint $table) {
                $table->integer('user_id')->unsigned();
                $table->integer('role_id')->unsigned();
                $table->nullableTimestamps();

                $table->engine = 'InnoDB';
                $table->primary(['user_id', 'role_id']);
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
