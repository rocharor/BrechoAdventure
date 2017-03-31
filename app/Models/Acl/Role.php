<?php

namespace App\Models\Acl;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    /**
     * Relation Permissions
     * @return object
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    /**
     * Exemplo de criar relação entre ROLE e PERMISSION
     *
     */
    //  $r = new Role; = Objeto ROLE
    //  $adm = $r->find(1); = Escolho a  ROLE que vou inserir
    //  Ações na tabela permission_role
    // $adm->permissions()->attach(1); Cria relação com o ID 1 da PERMISSION
    // $adm->permissions()->sync([1,2,...]); Cria relação com o array de IDs da PERMISSION
    // $adm->permissions()->detach(1); Deleta a relação do ID especificado
}
