<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {   
        Model::reguard();

        $students = Storage::get('public/students_seeder.csv');
        $students = explode("\r\n", $students);
        $s_attrs = explode(",", $students[0]);
        $users = [];

        for ($i=1; $i < count($students); $i++) {
            if($students[$i]){
                $student = explode(",", $students[$i]);
                for ($j=0; $j < count($student); $j++) { 
                    $user[$s_attrs[$j]] = $student[$j];
                }
                $user_c = \App\Models\User::create( $user );
                $user['user_id'] = $user_c->id;
                $student = \App\Models\Student::create( $user );
                $users[] = $user;
            }   
        }
    }
}
