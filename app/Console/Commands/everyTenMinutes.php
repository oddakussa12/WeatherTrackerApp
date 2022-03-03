<?php

namespace App\Console\Commands;

use App\Models\City;
use Illuminate\Console\Command;

class everyTenMinutes extends Command
{
    
    protected $signature = 'fetch:weatherdata';

  
    protected $description = 'Fetch weather data for cities from API every ten minute';


    public function __construct()
    {
        parent::__construct();
    }


    public function handle()
    {
        // get all the id of the cities in our database
        $cities = City::select('city_id')->get();
        // for each of the city, get their updated record from the api
        foreach($cities as $city){
            // return $city->city_id;
            $client = new \GuzzleHttp\Client();
            $response = $client->request('GET', 'https://api.openweathermap.org/data/2.5/weather?id='.$city->city_id.'&appid=4c7f1f68689243332f5672f3f5d973e0', [
                'headers' => [
                'Accept' => 'application/json',
                // 'Authorization' => 'Basic BgxsDwd00n.LNNn90QydrjgZ1K9dS13',
            ],
            ]);
            $data = $response->getBody();
            $obj = json_decode($data);
            // return $obj->wind->speed;

            // get the city from the DB to update its record by api response
            $city = City::where('city_id',$city->city_id)->first();

            $city->weather = $obj->weather[0]->main;
            $city->temprature = $obj->main->temp;
            $city->feels_like = $obj->main->feels_like;
            $city->humidity = $obj->main->humidity;
            $city->wind_speed = $obj->wind->speed;
            $city->lat = $obj->coord->lat;
            $city->long = $obj->coord->lon;
            
            $city->save();
        }
        // return 0;
        echo "Weather record updated successfully";
    }
}
