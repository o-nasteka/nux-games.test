<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;
use App\Console\Commands\CleanExpiredLinks;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('links:clean', function () {
    $this->handle();
})->describe('Delete expired access links');

Schedule::command(CleanExpiredLinks::class)->daily();
