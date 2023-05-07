<?php

namespace App\Providers;

use App\Models\Modulo;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        $modulos = Modulo::get();
        foreach ($modulos as $modulo) {
            Gate::define($modulo->name, function (User $user) use ($modulo){
                return self::verificar($user, $modulo->id);
            });
        }

    }

    public static function verificar(User $user, string $permissao)
    {
        return in_array($permissao, $user->permissao->pluck('id')->toArray());
    }
}
