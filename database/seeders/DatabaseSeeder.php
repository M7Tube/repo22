<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\HandOver;
use App\Models\InProgressInspection;
use App\Models\Role;
use App\Models\Subject;
use App\Models\Template;
use App\Models\User;
use App\Models\VisitType;
use Carbon\Carbon;
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
            'pic' => 'logo.png',
            'instructions' => 'Test From Mahmoud',
            'signatures' => '[{"title":"hehe"},{"title":"hwhw"}]',
            'user_id' => '1',
        ]);
        Template::Create([
            'name' => 'hwhwhwh',
            'desc' => 'hahahahah',
            'pic' => 'logo.png',
            'with_visit_type' => 1,
            'instructions' => 'Test From Mahmoud',
            'signatures' => '[{"title":"hehe"},{"title":"hwhw"}]',
            'user_id' => '1',
        ]);
        Template::Create([
            'name' => 'heeeeeeeee',
            'desc' => 'hwwwwwwwwww',
            'pic' => 'logo.png',
            'instructions' => 'Test From Mahmoud',
            'signatures' => '[{"title":"hehe"},{"title":"hwhw"}]',
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
        InProgressInspection::Create([
            'name' => 'gjkjgv',
            'desc' => 'dfasweqr',
            'location' => 'qerwq',
            'date' => Carbon::now(),
            'doc_no' => 1,
            'value' => '[{"category_id":1,"name":"FirstQuestion","template_id":"1","created_at":"2022-05-10T22:35:51.000000Z","updated_at":"2022-05-10T22:35:51.000000Z","api":{"att":[{"attrubite_id":1,"name":"whatisthestateoffirealarm","status":[{"key":"good","value":"success"},{"key":"bad","value":"danger"},{"key":"half","value":"secondary"},{"key":null,"value":"0"}],"template_id":"1","category_id":"1","created_at":"2022-05-10T22:37:28.000000Z","updated_at":"2022-05-10T22:37:28.000000Z"},{"attrubite_id":2,"name":"Whatsisthestatefullbuilder","status":[{"key":"asdf","value":"success"},{"key":"asdfadf","value":"secondary"},{"key":"asdfasdf","value":"success"},{"key":"asdfasdf","value":"0"}],"template_id":"1","category_id":"1","created_at":"2022-05-16T19:05:45.000000Z","updated_at":"2022-05-16T19:05:45.000000Z"}],"selector":[{"selector_id":1,"name":"Chooseonevaluefromselector","values":"obada,mahmoud,asdf","template_id":"1","category_id":"1","created_at":"2022-05-10T22:40:46.000000Z","updated_at":"2022-05-10T22:40:46.000000Z"},{"selector_id":2,"name":"Chooseonevaluefromselector","values":"obada,mahmoud,asdf,sdafdasd,asdfas,dfasdf,asdfas,dfas,df","template_id":"1","category_id":"1","created_at":"2022-05-16T19:06:14.000000Z","updated_at":"2022-05-16T19:06:14.000000Z"}],"textbox":[{"box_id":1,"name":"Inputthestateofpetrolpump","is_required":"1","is_number":"1","template_id":"1","category_id":"1","created_at":"2022-05-10T22:44:09.000000Z","updated_at":"2022-05-10T22:44:09.000000Z"},{"box_id":5,"name":"sadfasdf","template_id":"1","category_id":"1","created_at":"2022-05-16T19:07:02.000000Z","updated_at":"2022-05-16T19:07:02.000000Z"}]}},{"category_id":2,"name":"FirstCateogary","template_id":"1","created_at":"2022-05-10T22:36:02.000000Z","updated_at":"2022-05-10T22:36:02.000000Z","api":{"att":[],"selector":[],"textbox":[]}},{"category_id":3,"name":"SecondCateogary","template_id":"1","created_at":"2022-05-10T22:36:15.000000Z","updated_at":"2022-05-10T22:36:15.000000Z","api":{"att":[],"selector":[],"textbox":[]}}]',
            'is_complated' => 0
        ]);
        InProgressInspection::Create([
            'name' => 'fdas',
            'desc' => 'dfaasewrsweqr',
            'location' => 'werq',
            'date' => Carbon::now(),
            'doc_no' => 1,
            'value' => null,
            'is_complated' => 1
        ]);
        VisitType::Create([
            'name' => 'test'
        ]);
        //;'
    }
}
