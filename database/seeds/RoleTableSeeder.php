<?php

use App\Role;
use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = ['administrator','subscriber','user'];

        foreach ($roles as $role){
            Role::create(['name'=>$role]);
        }
        //
    }
}
