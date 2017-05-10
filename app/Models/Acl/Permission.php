<?php

namespace App\Models\Acl;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $table = 'permissions';
    protected $dates = ['deleted_at'];

    /**
     * Relation Roles
     * @return object
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
}
