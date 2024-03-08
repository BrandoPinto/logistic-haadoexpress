<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
       $role_admin = Role::create(['name'=>'Admin']);
       $role_almacenero = Role::create(['name'=>'Almacenero']);
       $role_delivery = Role::create(['name'=>'Delivery']);
       $role_cliente1 = Role::create(['name'=>'Cliente1']);
       $role_cliente2 = Role::create(['name'=>'Cliente2']);
       $role_cliente3 = Role::create(['name'=>'Cliente3']);
       $role_cliente4 = Role::create(['name'=>'Cliente4']);
       $user = User::find(1);
       $user->assignRole($role_admin);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        
    }
};
