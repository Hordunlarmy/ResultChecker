<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\ScratchCard;
use Illuminate\Support\Str;

class GenerateScratchCards extends Command
{
    // The name and signature of the console command
    protected $signature = 'scratchcards:generate {count=1}';

    // The console command description
    protected $description = 'Generate scratch cards and return their PINs';

public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $count = $this->argument('count');
        if ($count < 1 || $count > 1000) {
            $this->error('The count must be between 1 and 1000.');
            return 1;
        }

        $scratchCards = [];
        for ($i = 0; $i < $count; $i++) {
            $pin = strtoupper(Str::random(4) . '-' . Str::random(4) . '-' . Str::random(4) . '-' . Str::random(4));
            $scratchCards[] = ScratchCard::create([
                'pin' => $pin,
                'is_used' => false,
            ])->pin;
        }

        $this->info('Scratch cards generated successfully:');
        foreach ($scratchCards as $pin) {
            $this->line($pin);
        }

        return 0;
    }
}
