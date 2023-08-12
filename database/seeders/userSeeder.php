<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;
class userSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user_list = Permission::create(['name' => 'users.list']);
        $user_view = Permission::create(['name' => 'users.view']);
        $user_create = Permission::create(['name' => 'users.create']);
        $user_update = Permission::create(['name' => 'users.update']);
        $user_delete = Permission::create(['name' => 'users.delete']);


        $admin_role  = Role::create(['name' =>'admin']);
        $admin_role->givePermissionTo([
            $user_create,
            $user_view,
            $user_create,
            $user_update,
            $user_delete,
            $user_list,
        ]);
        $admin = User::create([
            'name' => 'admin',
            'email' =>'admin@admin.com',
            'password' => bcrypt('password')
        ]);

        $admin -> assignRole($admin_role);
        $admin -> givePermissionTo([
                       $user_list

        ]);


        // user section
        $user = User::create([
            'name' => 'user',
            'email' =>'user@user.com',
            'password' => bcrypt('password')
        ]);
        $user_role  = Role::create(['name' =>'user']);

        $user -> assignRole($user_role);
        $user -> givePermissionTo([
          
            $user_view,
            $user_list,
        ]);
          $user_role -> givePermissionTo([
          
            $user_view,
            $user_list,
        ]);

    }
}
