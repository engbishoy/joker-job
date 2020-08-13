<?php

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class adminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
     $admin= Admin::create([
            'name'=>'mina adel',
            'email'=>'mina@gmail.com',
            'password'=>Hash::make(1234567890),
            'code_phone'=>'02',
            'phone'=>'01152560703',
            'photo'=>'avatar5.png'
        ]);

        $admin->attachRole('super_admin');

    }
}
