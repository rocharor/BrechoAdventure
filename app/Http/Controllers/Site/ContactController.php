<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mail;
use App\Mail\BrechoMail;
use App\Events\sendEmailAdmin;
use App\Data\Repositories\Site\ContactRepository;

class ContactController extends Controller
{
    public $repository;

    public function __construct(ContactRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $data['tipos'] = $this->getTipoContato();

        return view('site/contact', [
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

        $response = $this->repository->store($request->all());

        if ($response) {
            Mail::to($request->email)->send(new BrechoMail(1, $request->all()));
            event(new sendEmailAdmin());

            return redirect()->route('contact')->with(
                'flashMessage',
                [
                    'message' => 'Enviado com sucesso!',
                    'type' => 'success'
                ]
            );
        } else {
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
