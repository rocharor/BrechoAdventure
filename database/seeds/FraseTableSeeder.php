<?php

use Illuminate\Database\Seeder;
use App\Models\Frase;

class FraseTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Frase::truncate();

        factory(Frase::class)->create([
            'frase' => 'Quanto mais você está em um estado de gratidão, mais vai atrair coisas pelas quais ser grato.'
        ]);
        factory(Frase::class)->create([
            'frase' => 'Ser feliz nem sempre vai te fazer grato, mas ser grato sempre vai te fazer feliz.'
        ]);
        factory(Frase::class)->create([
            'frase' => 'Gratidão traz um sentido para o ontem, paz para o presente, e cria uma visão positiva para o amanhã.'
        ]);
        factory(Frase::class)->create([
            'frase' => 'Gratidão traz um sentido para o ontem, paz para o presente, e cria uma visão positiva para o amanhã.'
        ]);
        factory(Frase::class)->create([
            'frase' => 'Quando a vida lhe dá toda a razão de ser negativo, pense em uma boa razão para ser positivo. Há sempre algo pelo qual ser grato.'
        ]);
        factory(Frase::class)->create([
            'frase' => 'Dias bons dão-lhe felicidade e dias ruins dão-lhe sabedoria. Ambos são essenciais.'
        ]);
        factory(Frase::class)->create([
            'frase' => 'A vida muda a cada dia, e suas bênçãos irão gradualmente mudar junto com ela.'
        ]);
        factory(Frase::class)->create([
            'frase' => 'A circunstância (ou pessoa) que você toma por garantida hoje pode vir a ser a única da qual você precise amanhã.'
        ]);
        factory(Frase::class)->create([
            'frase' => 'Enquanto você expressa sua gratidão, não deve esquecer que a maior valorização não é simplesmente proferir palavras, mas vivê-las diariamente'
        ]);
        factory(Frase::class)->create([
            'frase' => 'Na agitação da vida cotidiana, quase não percebemos que recebemos muito mais do que damos, e a vida não pode ser rica sem essa gratidão.'
        ]);
        factory(Frase::class)->create([
            'frase' => 'Seja grato porque seus caminhos se cruzaram e por ter tido a oportunidade de experimentar algo maravilhoso.'
        ]);

        // factory(Frase::class, 15)->create();
    }
}
