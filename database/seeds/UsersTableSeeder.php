<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
 
//Permissions
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Traits\HasRoles;

use App\User;

class UsersTableSeeder extends Seeder
{
    use HasRoles;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    { 
        
        //create Roles 
        $rolesCreate = ['super admin','admin','writter'];
        foreach($rolesCreate as $role){
            $checkRole = Role::where(['name'=>$role])->first();
            if($checkRole==null){
               Role::create(['name' => $role]); 
            } 
        }

        //Create Default Users
        $userArray = array(
            ['name'=>'Super Admin','email'=>'superadmin@test.com','password'=>bcrypt('12345'),'active'=>'1'],
            ['name'=>'Admin','email'=>'admin@test.com','password'=>bcrypt('12345'),'active'=>'1'],
            ['name'=>'Writter','email'=>'writter@test.com','password'=>bcrypt('12345'),'active'=>'1']
        );
        $userRoles = ['super admin','admin','writter']; 

        User::truncate();
        foreach($userArray as $key => $user){
            $checkUser = User::where(['email'=>$user['email']])->first();
            if($checkUser==null){
               $createdUser = User::create($user); 
               if($createdUser){
                  $createdUser->assignRole($userRoles[$key]); 
               }
            } 
        }
       

        // $user = User::find(6); 
       //  dd($user);
       // echo 'dsdsd';

        // DB::table('users')->insert([
        //     'name' => 'Admin',
        //     'email' => 'admin@gmail.com',
        //     'email' => 'admin@gmail.com',
        //     'password' => bcrypt('12345'),
        //     'active' => '1',

        // ]);
    }
}
