<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DestinationTableSeeder extends Seeder {

    /**
     * Seed the Destination table from json
     * 
     * @return [type] [description]
     */
    public function run()
    {
        DB::table('destinations')->delete();

        $destinationJson = File::get(storage_path() . "/jsondata/destination.json");
        $destination = json_decode($destinationJson);
        foreach ($destination as $item) 
        {
        	App\Destination::create(array(
        		'name' => $item->name,
                'slug' => $item->slug,
                'code' => $item->code
        	));
        }
    }
}
