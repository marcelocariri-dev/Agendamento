<?php

namespace App\Policies;

use App\Models\Agendamento;
use App\Models\User;

class AgendamentoPolicy
{
public function before (User $user, string $ability): ?bool{
if($user->hasrole('admin')){
    return true;

}
return null;

}

public function viewany(User $user){
    return $user->hasAnyPermission(['agendamentos.listar', 'agendamentos.listar_todos']);
}

public function view(User $user, Agendamento $agendamento){
return $user->hasAnyPermission(['agendamentos.listar', 'agendamentos.listar_todos']);

}

public function create (User $user){
    return $user->hasPermissionTo(['agendamentos.criar']);
}
}
