<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\HandOver;
use App\Models\Role;
use App\Models\Subject;
use App\Models\Template;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        Subject::Create([
            'name' => 'Installation',
            'lang' => 'en'
        ]);
        Subject::Create([
            'name' => 'Supply and installation',
            'lang' => 'en'
        ]);
        Subject::Create([
            'name' => 'Supply only',
            'lang' => 'en'
        ]);
        Subject::Create([
            'name' => 'Maintenance',
            'lang' => 'en'
        ]);
        Subject::Create([
            'name' => 'تركيب',
            'lang' => 'ar'
        ]);
        Subject::Create([
            'name' => 'تزويد وتركيب',
            'lang' => 'ar'
        ]);
        Subject::Create([
            'name' => 'معدات فقط',
            'lang' => 'ar'
        ]);
        Subject::Create([
            'name' => 'صيانة',
            'lang' => 'ar'
        ]);
        Department::Create([
            'name' => 'Damascus',
            'address' => 'Syria,Damascus,Mazzeh'
        ]);
        Role::Create([
            'name' => 'Main Admin',
        ]);
        Role::Create([
            'name' => 'Sales Manager',
        ]);
        Role::Create([
            'name' => 'Report Manager',
        ]);
        User::Create([
            'name' => 'Mahmoud',
            'email' => 'clashroyale.mahh@gmail.com',
            'password' => Hash::make('absamer11111'),
            'department_id' => 1,
            'role_id' => 1
        ]);
        Template::Create([
            'name' => 'Test',
            'desc' => 'hahahahah',
            'pic' => 'https://c-rpt.com/storage/app/images/logo.png',
            'user_id' => '1',
        ]);
        Template::Create([
            'name' => 'hwhwhwh',
            'desc' => 'hahahahah',
            'pic' => 'https://c-rpt.com/storage/app/images/logo.png',
            'user_id' => '1',
        ]);
        Template::Create([
            'name' => 'heeeeeeeee',
            'desc' => 'hwwwwwwwwww',
            'pic' => 'https://c-rpt.com/storage/app/images/logo.png',
            'user_id' => '1',
        ]);
        HandOver::Create([
            'note' => 'test1',
            'name' => 'tesstts',
            'signture1' => 'cars.jpg',
            'signture1Name' => 'mahmoud',
            'signture2' => 'cars.jpg',
            'signture2Name' => 'Obada',
            'Doc_No' => '1',
        ]);
    }
}
