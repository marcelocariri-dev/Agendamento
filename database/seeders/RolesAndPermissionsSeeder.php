<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //   // Limpa cache de permissões
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions =[

            'agendamentos.listar',
            'agendamentos.listar_todos',
            'agendamentos.criar',
            'agendamentos.editar',
            'agendamentos.deletar',

            // Locais
            'locais.listar',
            'locais.criar',
            'locais.editar',
            'locais.deletar',

            // Usuários
            'usuarios.listar',
            'usuarios.criar',
            'usuarios.editar',
            'usuarios.deletar',

        ];
        foreach($permissions as $permission){
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'sanctum' ] );
        }

        //criar papeis
//admin
$admin = Role::firstOrCreate(['name' => UserRole::ADMIN->value,  'guard_name' => 'sanctum']);
$admin->syncPermissions(Permission::all());

//gestor
$gestor = Role::firstOrCreate(['name' => UserRole::GESTOR->value,  'guard_name' => 'sanctum']);

$gestor->syncPermissions([
    'agendamentos.listar',
            'agendamentos.criar',
            'agendamentos.editar',
            'agendamentos.deletar',
            'locais.listar',
            'locais.criar',
            'locais.editar'

]);

//Funcionário

$funcionario = Role::firstOrCreate(['name' => UserRole::FUNCIONARIO->value,  'guard_name' => 'sanctum']);

$funcionario->syncPermissions([
    'agendamentos.listar',
    'agendamentos.criar',
     'agendamentos.editar',
    'agendamentos.deletar',
'locais.listar'

]);

    }
}
