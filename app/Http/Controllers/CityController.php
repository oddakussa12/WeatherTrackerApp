<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;
use Validator;

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
            $city->lat = $obj->coord->lat;
            $city->long = $obj->coord->lon;
            
            $city->save();
        }
        // return "Done";
        
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
        $rules = array(
            'city_id' => 'required|unique:cities',
            'city_name' => 'required',
        );
        $error = Validator::make($request->all(),$rules);
        if($error->fails()){
            return response()->json(['errors' => $error->errors()->all()]);
        }
        $city = new City();
        $city->city_id = $request->city_id;
        $city->city_name = $request->city_name;
        $city->save();
        
        if ($city->exists) {
            return response()->json(['success' => 'New city addedsuccessfuly'], 200);
        } else {
            return response()->json(['error' => 'Error'], 422);
        }
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

    
    public function destroy(Request $request)
    {
        $city = City::where('city_id',$request->id)->first();
        if($city){
            $city->delete();
            return response()->json(['success' => 'City deleted successfuly'], 200);
        }else{
            return response()->json(['error' => 'Delete unsuccessful, City not found'], 404);
        }
    }
}
