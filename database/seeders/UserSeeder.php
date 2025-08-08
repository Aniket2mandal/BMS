<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $password=Hash::make('password');
        $adminUser = User::create(['name' => 'Admin','email'=>'admin@gmail.com','password'=>$password,'status'=>1]);
        $adminUser->syncRoles('Admin');
        $permissions = Permission::all();
        $role = Role::where('name', 'Admin')->first();
        if($role){
            $role->syncPermissions($permissions);
            }
    }
}
