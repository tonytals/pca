<?php

namespace ProntuarioEletronico\Providers;

use ProntuarioEletronico\Permissao;
use ProntuarioEletronico\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        //'ProntuarioEletronico\Model' => 'ProntuarioEletronico\Policies\AdminPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
     public function boot()
     {
        $this->registerPolicies();

        Gate::after(function ($user, $ability, $result, $arguments) {
            if(!Permissao::where('nome', '=', $ability)->first() && $user->eAdmin()){
                echo "Regra utilizada não existe: <b>" . $ability . "</b>";
                die;
            };
        });

       foreach ($this->listaPermissoes() as $permissao) {
         Gate::define($permissao->nome,function($user) use($permissao){
           return $user->temUmPapelDestes($permissao->papeis) || $user->eAdmin();
         });
       }

     }

     public function listaPermissoes()
     {
       return Permissao::with('papeis')->get();
     }
}
