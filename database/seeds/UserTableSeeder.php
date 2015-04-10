<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class UserTableSeeder extends Seeder {

    /**
     * Seed the User table from json
     * 
     * @return [type] [description]
     */
    public function run()
    {
        DB::table('users')->delete();

        $usersJson = File::get(storage_path() . "\jsondata\user.json");
        $user = json_decode($usersJson);
        foreach ($user as $item) 
        {
        	App\User::create(array(
        		'provider_id' => $item->provider_id,
                'name' => $item->name,
                'avatar' => $item->avatar,
                'email' => $item->email,
                'link' => $item->link
        	));
        }
    }
}