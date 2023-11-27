<?php

namespace App;

class Weather
{
    public function __construct(public string $apikey)
    {
    }

    public function isSunnyTomorrow()
    {
        return $this->apikey;
    }
}