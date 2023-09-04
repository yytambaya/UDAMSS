<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;

class LecturerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Model::reguard();

        $lecturers = Storage::get('public/lecturers_seeder.csv');
        $lecturers = explode("\r\n", $lecturers);
        $l_attrs = explode(",", $lecturers[0]);
        $users = [];
        
        for ($i=1; $i < count($lecturers); $i++) {
            if($lecturers[$i]){
                $lecturer = explode(",", $lecturers[$i]);
                for ($j=0; $j < count($lecturer); $j++) { 
                    $user[$l_attrs[$j]] = $lecturer[$j];
                }
                $user_c = \App\Models\User::create( $user );
                $user['user_id'] = $user_c->id;
                $lecturer = \App\Models\Lecturer::create( $user );
                $users[] = $user;
            }
        }
    }
}
