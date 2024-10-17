<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;



class RoleAndPermessionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
       $arrayofallpermessiomsnames=[
            'View categories','Create categories','Update categories','Delete categories','View products','Create products','Update products','Delete products','View orders',
            'Create orders','orders.update','Update orders','Delete orders',
            'View users','Create users','Update users','Delete users','View roles','Create roles','Update roles','Delete roles','Resotre roles','Force delete roles',
        ];

        $Superadminpermessiomsnames=[
            'View categories','Create categories','Update categories','Create roles','Update roles','Delete roles','Resotre roles','Force delete roles',
        ];


        $permessions=collect($arrayofallpermessiomsnames)->map(function($permession){
        return ['name'=>$permession,'guard_name'=>'web'];
        });
        Permission::insert($permessions->toArray());

        $role=Role::create(['name'=>'owner'])->givePermissionTo($arrayofallpermessiomsnames);
        $role=Role::create(['name'=>'super_admin'])->givePermissionTo($Superadminpermessiomsnames);


    }
}
