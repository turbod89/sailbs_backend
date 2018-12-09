<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        \App\Role::updateOrCreate([
            'code' => 'admin'
        ],[]);

        \App\Role::updateOrCreate([
            'code' => 'student'
        ],[]);

        \App\Role::updateOrCreate([
            'code' => 'teacher'
        ],[]);

        \App\Role::updateOrCreate([
            'code' => 'coordinator'
        ],[]);


        self::setNames();

    }


    public function setNames() {
        $role = \App\Role::where(['code' => 'admin'])->first();
        \App\RoleTranslation::updateOrCreate([
            'role_id' => $role->id,
            'locale' => 'en'
            ],[
                'short_name' => 'Admin',
                'name' => 'Administrator',
                'Description' => 'Administrator users can do all kind of things.',
        ]);
        \App\RoleTranslation::updateOrCreate([
            'role_id' => $role->id,
            'locale' => 'es'
        ],[
            'short_name' => 'Admin',
            'name' => 'Administrador',
            'Description' => 'Los administradores pueden hacer todo tipo de cosas.',
        ]);


        $role = \App\Role::where(['code' => 'student'])->first();
        \App\RoleTranslation::updateOrCreate([
            'role_id' => $role->id,
            'locale' => 'en'
        ],[
            'short_name' => 'Student',
            'name' => 'Student',
            'Description' => 'Students only can do exams.',
        ]);
        \App\RoleTranslation::updateOrCreate([
            'role_id' => $role->id,
            'locale' => 'es'
        ],[
            'short_name' => 'Estudiante',
            'name' => 'Estudiante',
            'Description' => 'Los estudiantes solo pueden hacer examenes.',
        ]);



        $role = \App\Role::where(['code' => 'teacher'])->first();
        \App\RoleTranslation::updateOrCreate([
            'role_id' => $role->id,
            'locale' => 'en'
        ],[
            'short_name' => 'Teacher',
            'name' => 'Teacher',
            'Description' => 'Teacher description.',
        ]);
        \App\RoleTranslation::updateOrCreate([
            'role_id' => $role->id,
            'locale' => 'es'
        ],[
            'short_name' => 'Profe',
            'name' => 'Profesor',
            'Description' => 'Descripción de los profesores.',
        ]);


        $role = \App\Role::where(['code' => 'coordinator'])->first();
        \App\RoleTranslation::updateOrCreate([
            'role_id' => $role->id,
            'locale' => 'en'
        ],[
            'short_name' => 'Coord',
            'name' => 'Coordinator',
            'Description' => 'Coordinator description.',
        ]);
        \App\RoleTranslation::updateOrCreate([
            'role_id' => $role->id,
            'locale' => 'es'
        ],[
            'short_name' => 'Coordi',
            'name' => 'Coordinador',
            'Description' => 'Descripción de los cordinadores.',
        ]);



    }
}
