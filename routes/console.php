<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use App\Console\Commands\GenerateScratchCards;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();


Artisan::command('scratchcards:generate {count}', function ($count) {
    $this->call(GenerateScratchCards::class, ['count' => $count]);
})->purpose('Generate scratch cards and return their PINs');
