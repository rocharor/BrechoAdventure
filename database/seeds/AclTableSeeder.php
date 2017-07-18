<?php

use Illuminate\Database\Seeder;
use App\Models\Acl\Permission;
use App\Models\Acl\Role;

class AclTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->truncate();
        DB::table('roles')->insert([
            'name' => 'administrador-master',
            'label' => 'Administrador master do sistema'
        ]);
        DB::table('roles')->insert([
            'name' => 'administrador',
            'label' => 'Administrador restrito do sistema'
        ]);
        DB::table('roles')->insert([
            'name' => 'usuario',
            'label' => 'Usuário comum'
        ]);


        DB::table('permissions')->truncate();
        DB::table('permissions')->insert([
            'name' => 'admin-master',
            'label' => 'Acesso total ao admin do site'
        ]);
        DB::table('permissions')->insert([
            'name' => 'admin',
            'label' => 'Acesso restrito ao admin do site'
        ]);       


        DB::table('role_user')->truncate();
        DB::table('role_user')->insert([
            'user_id' => 1,
            'role_id' => 1
        ]);

        DB::table('permission_role')->truncate();
        DB::table('permission_role')->insert([
            'role_id' => 1,
            'permission_id' => 1
        ]);
        DB::table('permission_role')->insert([
            'role_id' => 2,
            'permission_id' => 2
        ]);
    }
}
