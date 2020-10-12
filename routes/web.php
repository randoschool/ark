<?php

use App\Mail\NewAvaliableTimes;
use Goutte\Client;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

use function PHPUnit\Framework\isInstanceOf;

Route::get('/', function () {
});
