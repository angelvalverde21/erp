<?php

namespace App\Http\Livewire\Manage\Roles;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Spatie\Permission\Models\Role;
use stdClass;

class ShowRoles extends Component
{

    public $user;

    public function mount($user)
    {
        $this->user = $user;
    }

    
    public function removeAdd($value = 1){

        //Buscamos el rol
        $role = Role::findByName($value);

        //si el usuario tiene el rol 
        if ($this->user->hasRole($value)) {
            // entonces le quitamos el rol
            $this->user->removeRole($role);
        } else {
            //sino se lo asignamos
            $this->user->assignRole($role);
        }
    
    }


    public function render()
    {

        $roles = Role::all();

        $userRoles = $this->user->roles;

        // $arrayRoles = $roles->toArray();

        $arrayRoles = array_map(function ($role) {
            return $role['name'];
        }, $roles->toArray());

        Log::info($arrayRoles);


        $arrayUserRoles = array_map(function ($role) {
            return $role['name'];
        }, $userRoles->toArray());

        Log::info($arrayUserRoles);

        // $selectedRoles = array_map(function ($role) use ($userRoles) {

        //     foreach ($userRoles as $userRole) {
        //         # code...
        //         if ($role['name'] === $userRole->name) {
        //             return [
        //                 'name' => $userRole->name,
        //                 'has_role' => 1,
        //             ];
        //         } else {
        //             return [
        //                 'name' => $role['name'],
        //                 'has_role' => 0,
        //             ];
        //         }

        //     }

        // }, $roles->toArray());

        $selectedRoles = array_map(function ($role) use ($arrayUserRoles) {

            if (in_array($role, $arrayUserRoles)) {
                return [
                    'name' => $role,
                    'has_role' => 1,
                ];
            } else {
                return [
                    'name' => $role,
                    'has_role' => 0,
                ];
            }
            // return [
            //     'name' => $role['name'],
            //     in_array($role, $arrayUserRoles) ? 'Match' : 'No match',
            // ];
        }, $arrayRoles);


        // foreach ($roles as $role) {
        //     # code...

        // }

        Log::info($selectedRoles);

        return view('livewire.manage.roles.show-roles', compact('roles', 'userRoles', 'selectedRoles'));
    }
}
