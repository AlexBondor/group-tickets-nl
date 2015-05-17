<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class GroupTableSeeder extends Seeder {

    /**
     * Seed the Group table from json
     * 
     * @return [type] [description]
     */
    public function run()
    {
        DB::table('groups')->delete();

        $groupsJson = File::get(storage_path() . "\jsondata\group.json");
        $group = json_decode($groupsJson);
        foreach ($group as $item) 
        {
            $time = rand( strtotime("Apr 10 2015"), strtotime("Jul 31 2015") );
        	App\Group::create(array(
        		'destination_id' => $item->destination_id,
                'slots' => $item->slots,
                'date' => date('Y-m-d', $time)
        	));
        }
    }
}