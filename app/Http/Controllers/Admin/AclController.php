<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\DashboardController;
use App\Models\Acl\Role;
use App\Models\Acl\Permission;
use DB;

class AclController extends Controller
{
    public $dataTop;
    public $modelRole;
    public $modelPermission;

    public function __construct(DashboardController $dashboard, Role $role, Permission $permission)
    {
        $this->dataTop = $dashboard->dashboard();
        $this->modelRole = $role;
        $this->modelPermission = $permission;
    }

    // ROLES
    public function listRoles()
    {
        $data = $this->dataTop;

        $data['roles'] = $this->modelRole->all();

        return view('admin/contents/acl/roles', [
            'data' => $data
        ]);
    }

    public function storeRole(Request $request)
    {
        $this->modelRole->name = $request->nome;
        $this->modelRole->label = $request->descricao;

        if ($this->modelRole->save()) {
            return redirect()->route('admin.acl.roles-list')->with('sucesso','Role criada com sucesso.');
        }

        return redirect()->route('admin.acl.roles-list')->with('erro','Erro ao criar role.');
    }

    public function deleteRole($id)
    {
        $retorno = $this->modelRole->find($id)->delete();

        if ($retorno) {
            return redirect()->route('admin.acl.roles-list')->with('sucesso','Role excluida com sucesso.');
        }

        return redirect()->route('admin.acl.roles-list')->with('erro','Erro ao excluir role.');
    }


    // PERMISSIONS
    public function listPermissions()
    {
        $data = $this->dataTop;

        $data['permissions'] = $this->modelPermission->all();

        return view('admin/contents/acl/permissions', [
            'data' => $data
        ]);
    }

    public function storePermission(Request $request)
    {
        $this->modelPermission->name = $request->nome;
        $this->modelPermission->label = $request->descricao;

        if ($this->modelPermission->save()) {
            return redirect()->route('admin.acl.permissions-list')->with('sucesso','Permission criada com sucesso.');
        }

        return redirect()->route('admin.acl.permissions-list')->with('erro','Erro ao criar permission.');
    }

    public function deletePermission($id)
    {
        $retorno = $this->modelPermission->find($id)->delete();

        if ($retorno) {
            return redirect()->route('admin.acl.permissions-list')->with('sucesso','Permission excluida com sucesso.');
        }

        return redirect()->route('admin.acl.permissions-list')->with('erro','Erro ao excluir permission.');
    }

    // ROLE PERMISSION
    public function listRolePermissions()
    {
        $data = $this->dataTop;

        $data['roles'] = $this->modelRole->all();
        $data['permissions'] = $this->modelPermission->all();

        $dados = DB::table('permission_role')->select()->get();
        $permissionRole = [];
        foreach ($dados as $value) {
            if (!isset($permissionRole[$value->role_id])) {
                $permissionRole[$value->role_id][] = $value->permission_id;
            }else{
                array_push($permissionRole[$value->role_id], $value->permission_id);
            }
        }

        foreach ($data['roles'] as $value) {
            $value->permissions = 0;
            if (isset($permissionRole[$value->id])) {
                $value->permissions = implode(',',$permissionRole[$value->id]);
            }
        }

        return view('admin/contents/acl/role_permission', [
            'data' => $data
        ]);
    }

    public function updateRolePermission(Request $request)
    {
        DB::table('permission_role')->truncate();

        foreach ($request->ckecks as $value) {
            $dados = explode('-', $value);
            $role = (int)$dados[0];
            $permission = (int)$dados[1];

            DB::table('permission_role')->insert([
                'role_id' => $role,
                'permission_id' => $permission
            ]);
        }

        return redirect()->route('admin.acl.role-permissions-list')->with('sucesso','Alterado com sucesso.');
    }

    public function updateRoleUser(Request $request)
    {
        try {
            DB::table('role_user')->where('user_id', $request->user_id)->delete();

            if ($request->ckecks) {
                foreach ($request->ckecks as $value) {
                    DB::table('role_user')->insert([
                        'role_id' => $value,
                        'user_id' => $request->user_id
                    ]);
                }
            }

            return redirect()->route('admin.user-edit', $request->user_id)->with('sucesso','Dados salvos com sucesso.');

        } catch (Exception $e) {

            return redirect()->route('admin.user-edit', $request->user_id)->with('erro','Erro ao salvar.');
        }
    }

}
