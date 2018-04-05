<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->truncate();

        $newUser = generateNewUser(10);

        foreach ($newUser as $user) {

            $user['created_at'] = Carbon\Carbon::now()->format('Y-m-d H:i:s');
            
            DB::table('users')->insert($user);
            
        }


    }
}
