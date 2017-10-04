<?php

use Illuminate\Database\Seeder;

class AdminTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $user_id = DB::table('users')->insert([
            'username' => 'admin',
            'email' => 'dhaval.patel13121985@gmail.com',
            'password' => md5('umaerp50'),            
            'first_name' => 'Dhaval',
            'last_name' => 'Desai',
            'created_at' => date('Y-m-d H:i:s')            
        ]);
        
        $role_id = DB::table('roles')->insert([
            'slug' => 'admin',
            'name' => 'admin',
            'permissions' => '',
            'created_at' => date('Y-m-d H:i:s')
        ]);
        
        DB::table('role_users')->insert([
            'user_id' => $user_id,
            'role_id' => $role_id,            
            'created_at' => date('Y-m-d H:i:s')
        ]);
    }

}
