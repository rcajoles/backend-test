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
        // $newUser = factory('App\Model\User', null)->make();
        // $newUser = generateNewUser(null, 'make');
        // dd($newUser);
        $jwt = config('jwt.now');
        $getPos = strpos($jwt, ':');
        // dd($jwt, $getPos);
        // dd(strtotime('now'), strtotime('20 hours'));
        $rightnow = strtotime('now');
        $offhour = strtotime('8pm');
        $offduty = localtime($offhour, true);
        
        $now = localtime(time(), true);
        $now_sec = localtime(time(), true)['tm_sec'];
        $now_min = localtime(time(), true)['tm_min'];
        $now_hour = localtime(time(), true)['tm_hour'];
		// localtime($rightnow - $offhour, true)
		dd(strtotime('8PM', $rightnow - $offhour));
        dd($now_hour, $now_min, $now_sec, date("h:i:sa", $rightnow - $offhour));
    }
}
