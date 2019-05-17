<?php

namespace App\Factories;

use Illuminate\Http\Request;
use App\Services\Action\CurrentWeatherService;
use App\Services\Action\WeatherByDateService;
use App\Services\Action\WebInstantAnswerService;
use App\Services\Action\VisionDescribeImageService;
use App\Services\Action\DefaultFallbackService;

class ActionFactory
{
    public function mapActionToService(Request $request)
    {
        if ($request['queryResult']['action'] == 'input.unknown') {
            return new DefaultFallbackService($request['queryResult']['queryText']);
        } else if ($request['queryResult']['action'] == 'weather.current') {
            return new CurrentWeatherService($request['queryResult']['parameters']['geo-city']);
        } else if ($request['queryResult']['action'] == 'weather.date') {
            return new WeatherByDateService($request['queryResult']['parameters']['geo-city'], $request['queryResult']['parameters']['date']);
        } else if ($request['queryResult']['action'] == 'web.instant_answer') {
            return new WebInstantAnswerService($request['queryResult']['parameters']['topic']);
        } else if ($request['queryResult']['action'] == 'vision.describe_image') {
            return new VisionDescribeImageService($request['originalDetectIntentRequest']['payload']['data']['message']['attachments'][0]['payload']['url']);
        }
    }
}
