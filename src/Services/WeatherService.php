<?php

namespace App\Services;



class WeatherService {

    protected $api;

    public function _contruct($api)
    {
        $this->api = $api;
    }


    public function api()
    {
        $this->api = array("Paris", "Londres", "Moscou", "Berlin", "Madrid", "San Francisco", "Mexico", "Brasilia", "Pekin", "Tokyo", "Bangkok", "Yaounde", "Libreville", "Pretoria", "Dakar");

   
        foreach ($this->api as $key) {
            $url = "https://api.openweathermap.org/data/2.5/weather?q=". $key ."&lang=fr&units=metric&appid=542a57b39110d46ded42ec5476c90354";
             
            $raw = file_get_contents($url);
            $json = json_decode($raw);
  
             
            $name = $json->name;
            $weather = $json->weather[0]->main;
            $desc = $json->weather[0]->description;
            $timeZone = $json->timezone;
            $timeSeconde = strtotime(date('H:i')) + $timeZone;
            $time = gmdate('H:i', $timeSeconde);
           
            $temp = $json->main->temp;
            $temp = round($temp, 0);
            $fell_like = $json->main->feels_like;
            $speed = $json->wind->speed;
            $deg = $json->wind->deg;

            $api[] = [
                'name' => $name,
                'weather' => $weather,
                'desc' => $desc,
                'temp' => $temp,
                'fells_like' => $fell_like,
                'speed' => $speed,
                'deg' => $deg,
                'time' => $time
            ];
        }

        return $api;
          
    }

}