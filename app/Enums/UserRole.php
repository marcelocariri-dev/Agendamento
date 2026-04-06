<?php

namespace App\Enums;

enum UserRole: string


{

    case ADMIN = 'admin';
case GESTOR = 'gestor';
case FUNCIONARIO = 'funcionario';
public function label(): string
{  #O método label() — é um método auxiliar a exibir nomes bonitos na interface:
    return match ($this) {
        self::ADMIN => 'Administrador',
        self::GESTOR => 'Gestor',
        self::FUNCIONARIO => 'Funcionário',
    };
}



}
