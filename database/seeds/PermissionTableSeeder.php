<?php

use Illuminate\Database\Seeder;
use App\Models\Acl\Permission;

class PermissionTableSeeder extends Seeder
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
    }
}
