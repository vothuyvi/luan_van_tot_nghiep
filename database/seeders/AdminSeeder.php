<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run():void
    {
        //

        $data=[
            'email'=>'admin@gmail.com',
            'Ten'=>'Gốm_Sứ',
            'password'=>bcrypt('123'),

        ];
        DB::table('admin')->insert($data);
    }
}
