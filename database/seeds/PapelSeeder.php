<?php

use Illuminate\Database\Seeder;
use ProntuarioEletronico\Papel;

class PapelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $p1 = Papel::firstOrCreate([
            'nome' =>'Admin',
            'descricao' => 'Acesso total ao sistema'
        ]);

        $p2 = Papel::firstOrCreate([
            'nome' =>'Aluno',
            'descricao' => 'Acesso para alunos'
        ]);


        echo "Papeis criados com sucesso!";
    }
}
