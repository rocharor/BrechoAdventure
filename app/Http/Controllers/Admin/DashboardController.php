<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Dashboard;

class DashboardController extends Controller
{
    public $model;

    public function __construct(Dashboard $dashboard)
    {
        $this->model = $dashboard;
    }

    public function index()
    {
        $data = $this->dashboard();

        return view('admin/contents/index', [
            'data' => $data
        ]);
    }

    public function dashboard()
    {
        $data = $this->model->getDatadashboard();

        foreach ($data['produtosPendentes'] as $produto) {
            $produto->imgPrincipal = $this->imagemPrincipal($produto->nm_imagem);
            $produto->updated_exibica = $this->formataDataExibicao($produto->updated_at);
        }

        return $data;
    }
}
