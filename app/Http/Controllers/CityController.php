<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function getWeatherData(){
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
            $city->save();
        }
        
    }
   
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(City $city)
    {
        //
    }

    public function edit(City $city)
    {
        //
    }

    public function update(Request $request, City $city)
    {
        //
    }

    
    public function destroy(City $city)
    {
        //
    }
}
