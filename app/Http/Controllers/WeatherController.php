<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class WeatherController extends Controller
{
    public function show(Request $request)
    {
        $city = $request->input('city', 'Tallinn');

        $weather = Cache::remember("weather_{$city}", 3600, function () use ($city) {
            $apiKey = config('services.openweather.key');
            $response = Http::get("https://api.openweathermap.org/data/2.5/weather", [
                'q' => $city,
                'appid' => $apiKey,
                'units' => 'metric',
            ]);

            return $response->successful() ? $response->json() : null;
        });

        return view('weather', compact('weather', 'city'));
    }
}
