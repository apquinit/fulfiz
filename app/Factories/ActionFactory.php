<?php

namespace App\Factories;

use Illuminate\Http\Request;
use App\Services\Action\CurrentWeatherService;
use App\Services\Action\WeatherByDateService;
use App\Services\Action\WebInstantAnswerService;

class ActionFactory
{
    public function mapActionToService(Request $request)
    {
        if ($request['queryResult']['action'] == 'weather.current') {
            return new CurrentWeatherService($request['queryResult']['parameters']['geo-city']);
        } else if ($request['queryResult']['action'] == 'weather.date') {
            return new WeatherByDateService($request['queryResult']['parameters']['geo-city'], $request['queryResult']['parameters']['date']);
        } else if ($request['queryResult']['action'] == 'web.instant_answer') {
            return new WebInstantAnswerService($request['queryResult']['parameters']['topic']);
        }
    }
}
