<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\DashboardController;
use App\Models\Site\Contato;
use Mail;
use Auth;
use App\Mail\BrechoMail;
use App\Events\sendEmailAdmin;

class ContactController extends Controller
{
    public $model;
    public $dataTop;

    public function __construct(DashboardController $dashboard, Contato $contato)
    {
        $this->model = $contato;
        $this->dataTop = $dashboard->dashboard();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = $this->dataTop;

        return view('admin/contents/listContacts', [
            'data' => $data
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = $this->dataTop;

        $contato_id = (int) $id;
        $data['contato'] = $this->model->getContato($contato_id);

        return view('admin/contents/viewContact', [
            'data' => $data
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        foreach ($request->all() as $key => $value) {
            if ($key == 'resposta') {
                $value = strip_tags($value);
            }
            $param[$key] = trim($value);
        }

        $param['user_id'] = Auth::user()->id;
        $retorno = $this->model->setRespostaMensagem($param);

        if ($retorno) {
            Mail::send(new BrechoMail(3, $param));

            return redirect()->route('admin.contact-list')->with('sucesso','Mensagem enviada com sucesso.');
        }

        return redirect()->route('admin.contact-list')->with('erro','Erro ao enviar a mensagem.');


        // $retorno = $this->model->updateAdmin($request->id, $param);
        //
        // if ($retorno) {
        //     return redirect()->route('admin.product-list')->with('sucesso','Status do produto alterado com sucesso.');
        // }
        //
        // return redirect()->route('admin.product-list')->with('erro','Erro ao atualizar status.');
    }
}
