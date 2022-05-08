<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         \App\Models\User::factory(7)->create();

        DB::table('users')->insert([
            [
                "name" => "Andrey",
                "email" => "andrey@test.com",
                "phone" => "9152281488",
                "password" => bcrypt('123')
            ]
        ]);

//         DB::table('worktimes')->insert([
//             [
//                 "user_id" => 1,
//                 "date" => "2022-05-07",
//                 "duration" => 60,
//                 "time_start" => "2022-05-07 13:23:00",
//                 "time_end" => "2022-05-07 13:24:00",
//             ],
//             [
//                 "user_id" => 1,
//                 "date" => "2022-05-07",
//                 "duration" => 60,
//                 "time_start" => "2022-05-07 14:23:00",
//                 "time_end" => "2022-05-07 14:24:00",
//             ],
//             [
//                 "user_id" => 1,
//                 "date" => "2022-05-07",
//                 "duration" => 60,
//                 "time_start" => "2022-05-07 15:23:00",
//                 "time_end" => "2022-05-07 15:24:00",
//             ],
//             [
//                 "user_id" => 2,
//                 "date" => "2022-05-07",
//                 "duration" => 60,
//                 "time_start" => "2022-05-07 13:23:00",
//                 "time_end" => "2022-05-07 13:24:00",
//             ],
//             [
//                 "user_id" => 3,
//                 "date" => "2022-05-07",
//                 "duration" => 60,
//                 "time_start" => "2022-05-07 13:23:00",
//                 "time_end" => "2022-05-07 13:24:00",
//             ],
//             [
//                 "user_id" => 2,
//                 "date" => "2022-05-07",
//                 "duration" => 60,
//                 "time_start" => "2022-05-07 14:23:00",
//                 "time_end" => "2022-05-07 14:24:00",
//             ],
//             [
//                 "user_id" => 2,
//                 "date" => "2022-05-07",
//                 "duration" => 60,
//                 "time_start" => "2022-05-07 15:23:00",
//                 "time_end" => "2022-05-07 15:24:00",
//             ]
//         ]);
//
//        DB::table('pauses')->insert([
//            [
//                "user_id" => 1,
//                "date" => "2022-05-07",
//                "duration" => 60,
//                "time_start" => "2022-05-07 13:23:00",
//                "time_end" => "2022-05-07 13:24:00",
//            ],
//            [
//                "user_id" => 1,
//                "date" => "2022-05-07",
//                "duration" => 60,
//                "time_start" => "2022-05-07 14:23:00",
//                "time_end" => "2022-05-07 14:24:00",
//            ],
//            [
//                "user_id" => 1,
//                "date" => "2022-05-07",
//                "duration" => 60,
//                "time_start" => "2022-05-07 15:23:00",
//                "time_end" => "2022-05-07 15:24:00",
//            ],
//            [
//                "user_id" => 2,
//                "date" => "2022-05-07",
//                "duration" => 60,
//                "time_start" => "2022-05-07 13:23:00",
//                "time_end" => "2022-05-07 13:24:00",
//            ],
//            [
//                "user_id" => 3,
//                "date" => "2022-05-07",
//                "duration" => 60,
//                "time_start" => "2022-05-07 13:23:00",
//                "time_end" => "2022-05-07 13:24:00",
//            ],
//            [
//                "user_id" => 2,
//                "date" => "2022-05-07",
//                "duration" => 60,
//                "time_start" => "2022-05-07 14:23:00",
//                "time_end" => "2022-05-07 14:24:00",
//            ],
//            [
//                "user_id" => 2,
//                "date" => "2022-05-07",
//                "duration" => 60,
//                "time_start" => "2022-05-07 15:23:00",
//                "time_end" => "2022-05-07 15:24:00",
//            ]
//        ]);
    }
}
