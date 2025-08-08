<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         // CAMP MODULE PERMISSIONS
         Permission::create(['name' => 'create camp','Slug'=>'create-camp']);
         Permission::create(['name' => 'edit camp','Slug'=>'edit-camp']);
         Permission::create(['name' => 'delete camp','Slug'=>'delete-camp']);
         Permission::create(['name' => 'view camp','Slug'=>'view-camp']);
 
         // DONOR PERMISSIONS
         Permission::create(['name' => 'create donor','Slug'=>'create-donor']);
         Permission::create(['name' => 'add bloodbank','Slug'=>'add-bloodbank']);
         Permission::create(['name' => 'edit donor','Slug'=>'edit-donor']);
         Permission::create(['name' => 'delete donor','Slug'=>'delete-donor']);
         Permission::create(['name' => 'view donor','Slug'=>'view-donor']);
 
         // BLOODBANK Permissions
         Permission::create(['name' => 'create bloodbank','Slug'=>'create-bloodbank']);
         Permission::create(['name' => 'edit bloodbank','Slug'=>'edit-bloodbank']);
         Permission::create(['name' => 'delete bloodbank','Slug'=>'delete-bloodbank']);
         Permission::create(['name' => 'view bloodbank','Slug'=>'view-bloodbank']);
 
         // User CRUD Permissions
         Permission::create(['name' => 'create user', 'slug' => 'create-users']);
         Permission::create(['name' => 'edit user', 'slug' => 'edit-users']);
         Permission::create(['name' => 'delete user', 'slug' => 'delete-users']);
         Permission::create(['name' => 'view user', 'slug' => 'view-users']);
 
         // BLOOD CRUD PERMISSIONS
         Permission::create(['name' => 'create blood', 'slug' => 'create-page']);
         Permission::create(['name' => 'edit blood', 'slug' => 'edit-page']);
         Permission::create(['name' => 'delete blood', 'slug' => 'delete-page']);
         Permission::create(['name' => 'view blood', 'slug' => 'view-page']);
         Permission::create(['name' => 'add quantity', 'slug' => 'add-quantity']);
 
         // Role Permissions
         Permission::create(['name' => 'assign role', 'slug' => 'assign-roles']);
         Permission::create(['name' => 'create role', 'slug' => 'create-roles']);
         Permission::create(['name' => 'edit role', 'slug' => 'edit-roles']);
         Permission::create(['name' => 'delete role', 'slug' => 'delete-roles']);
         Permission::create(['name' => 'view role', 'slug' => 'view-roles']);
 
         // Permission Permissions (for viewing and assigning permissions to roles)
         Permission::create(['name' => 'view permission', 'slug' => 'view-permissions']);
         Permission::create(['name' => 'assign permission', 'slug' => 'assign-permissions']);
 
         // STATUS PERMISSIOSN
         Permission::create(['name' => 'change user status','Slug'=>'change-user-status']);
         Permission::create(['name' => 'change blood status','Slug'=>'change-blood-status']);
         Permission::create(['name' => 'change bloodbank status','Slug'=>'change-bloodbank-status']);
         Permission::create(['name' => 'change camp status','Slug'=>'change-camp-status']);
         Permission::create(['name' => 'change donor status','Slug'=>'change-donor-status']);
 
         // SEO PERMISSION
        //  DB::table('permissions')->insert([
        //      'name' => 'view seo',
        //      'slug' => 'view-seo',
        //      'guard_name' => 'web'
        //  ]);
         
        //  DB::table('permissions')->insert([
        //      'name' => 'create field',
        //      'slug' => 'create-field',
        //      'guard_name' => 'web'
        //  ]);
         
        //  DB::table('permissions')->insert([
        //      'name' => 'edit seo',
        //      'slug' => 'edit-seo',
        //      'guard_name' => 'web'
        //  ]);
         
        //  DB::table('permissions')->insert([
        //      'name' => 'delete seo',
        //      'slug' => 'delete-seo',
        //      'guard_name' => 'web'
        //  ]);
         
    }
}
