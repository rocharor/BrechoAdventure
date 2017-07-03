<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\Dashboard;

class DashboardController extends Controller
{
    public $model;

    public function __construct(Dashboard $dashboard)
    {
        $this->model = $dashboard;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = $this->model->dashboard();

        foreach ($data['produtosPendentes'] as $produto) {
            $produto->imgPrincipal = $this->imagemPrincipal($produto->nm_imagem);
        }

        return view('admin/index', [
            'data' => $data
        ]);
    }
}
