<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\Site\Contato;

class ContactTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
     public function testBasicTest()
     {
         $response = $this->get('/');
         $response->assertStatus(200);
     }

     public function testDataContact()
     {
        $contato = new Contato;
        $retorno = $contato->getContato(1);

        $this->assertCount(1, ['teste']);
     }
}
