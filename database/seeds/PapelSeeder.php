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

        $p3 = Papel::firstOrCreate([
            'nome' =>'Preceptores',
            'descricao' => 'Acesso para Preceptores'
        ]);

        $p4 = Papel::firstOrCreate([
            'nome' =>'Tutor',
            'descricao' => 'Acesso para Tutores'
        ]);


        echo "Papeis criados com sucesso!";
    }
}
