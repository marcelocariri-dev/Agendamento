<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Local;

class LocalPolicy
{ #metodo before é chamado antes de qualquer metodo
    public function before (User $user, string $ability): ?bool //Pode retornar true, false ou null.

    {
        if ($user->hasRole('admin')){
            return true;
        }
return null;
    }

    public function viewAny(User $user): bool{
       return $user->hasPermissionTo('locais.listar');

    }

    public function view(User $user, Local $local): bool{
        return $user->hasPermissionTo('locais.listar');

     }


    public function create(User $user): bool
    {
        return $user->hasPermissionTo('locais.criar');
    }

    public function update(User $user, Local $local): bool
    {
        return $user->hasPermissionTo('locais.editar');
    }

    public function delete(User $user, Local $local): bool
    {
        return $user->hasPermissionTo('locais.deletar');
    }

}
