<?php

use App\Permission;
use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superAdmin = User::create([
            'firstname' => 'Ephantus',
            'lastname' => 'Okumu',
            'email' => 'ephantokumu98@gmail.com',
            'username'=>'Ephantus',
            'idnumber'=>'00144223355',
            'dateofbirth'=>'12/22/2010',
            'active'=>1,
            'status'=>1,
            'address'=> 'Nairobi',
            'uuid'=>'5efefe6466e4ere6dw',
            'phonenumber' => '254713197824',
            'password' => 'admin@123',
            'type' => 'super-admin',

        ]);

        $superAdmin->assignRole(['super-admin']);
        $superAdmin->givePermissionTo((Permission::all('name')->toArray()));

        $superAdmin = User::create([
            'firstname' => 'Isaac',
            'lastname' => 'Mungai',
            'email' => 'isaacmungai1997@gmail.com',
            'username'=>'isaac',
            'idnumber'=>'00144223355',
            'dateofbirth'=>'12/22/2010',
            'active'=>1,
            'status'=>1,
            'address'=> 'Nairobi',
            'uuid'=>'5efefe6466e4ere6dw',
            'phonenumber' => '254713197824',
            'password' => 'admin@123',
            'type' => 'super-admin',

        ]);

        $superAdmin->assignRole(['super-admin']);
        $superAdmin->givePermissionTo((Permission::all('name')->toArray()));




        $admin = User::create([
            'firstname' => 'John',
            'lastname' => 'Doe',
            'email' => 'okumuephantus@yahoo.com',
            'phonenumber' => '254103626004',
            'username'=>'Okumu',
            'idnumber'=>'0011278823355',
            'dateofbirth'=>'12/22/2010',
            'active'=>1,
            'status'=>1,
            'address'=> 'Nairobi',
            'uuid'=>'565461eedw65w65ew4ere6dw',
            'password' => 'admin@123',
            'type' => 'corporate',


        ]);

        $admin->assignRole(['corporate']);

        $admin = User::create([
            'firstname' => 'John',
            'lastname' => 'Doe',
            'email' => 'gmungai97kaiser@gmail.com',
            'phonenumber' => '254103626004',
            'username'=>'Okumu',
            'idnumber'=>'0011278823355',
            'dateofbirth'=>'12/22/2010',
            'active'=>1,
            'status'=>1,
            'address'=> 'Nairobi',
            'uuid'=>'565461eedw65w65ew4ere6dw',
            'password' => 'admin@123',
            'type' => 'corporate',


        ]);

        $admin->assignRole(['corporate']);


    }
}
