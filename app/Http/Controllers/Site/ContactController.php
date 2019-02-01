<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Mail;
use App\Models\Site\Contact;
use App\Models\Categoria;
use App\Mail\BrechoMail;
use App\Events\sendEmailAdmin;

class ContactController extends Controller
{
    public $model;

    public function __construct(Contact $contact)
    {
        $this->model = $contact;
    }

    public function index()
    {
        $data['tipos'] = $this->getTipoContato();

        return view('site/contact',[
            'breadCrumb' => $this->getBreadCrumb(),
            'data' => $data
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|email',
            'category' => 'required',
            'message' => 'required|max:150',
        ]);

        $dados = $request->all();

        $dados['category'] = $this->getTipoContato($dados['category']);
        $retorno = $this->model->setMensagem($dados);

        if($retorno){
            Mail::to($dados['email'])->send(new BrechoMail(1, $dados));
            event(new sendEmailAdmin());

            return redirect()->route('contact')->with(
                'flashMessage',
                [
                    'message' => 'Enviado com sucesso!',
                    'type' => 'success'
                ]
            );
        }else{
            return redirect()->route('contact')->with(
                'flashMessage',
                [
                    'message' => 'Erro ao enviar, tente novamente!',
                    'type' => 'danger'
                ]
            );
        }
    }
}
