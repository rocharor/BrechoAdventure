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
        Permission::truncate();
        factory(Permission::class)->create([
            'name' => 'admin',
            'label' => 'Acesso ao admin do site'
        ]);

        Role::truncate();
        factory(Role::class)->create([
            'name' => 'administrador',
            'label' => 'Administrador do sistema'
        ]);
        factory(Role::class)->create([
            'name' => 'usuario',
            'label' => 'Usuário comum'
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
    }
}
