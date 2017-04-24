<?php

use Illuminate\Database\Seeder;
use App\Models\Acl\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::truncate();

        factory(Role::class)->create([
            'name' => 'administrador',
            'label' => 'Administrador do sistema'
        ]);

        factory(Role::class)->create([
            'name' => 'usuario',
            'label' => 'Usuário comum'
        ]);
    }
}
