<?php

namespace App\Http\Controllers;

use App\Models\ScratchCard;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function generate(Request $request, $count = 1)
    {
        $this->validate($request, [
            'count' => 'required|integer|min:1|max:1000',
        ]);

        $count = $request->route('count') ?? 1;

        $scratchCards = [];
        for ($i = 0; $i < $count; $i++) {
            // Generate a random 16-character PIN (with letters and numbers)
            $pin = strtoupper(Str::random(4) . '-' . Str::random(4) . '-' . Str::random(4) . '-' . Str::random(4));

            // Create the scratch card in the database
            $scratchCards[] = ScratchCard::create([
                'pin' => $pin,
                'is_used' => false,
            ]);
        }

        $pins = array_map(function ($scratchCard) {
            return $scratchCard->pin;
        }, $scratchCards);

        return response()->json([
            'message' => 'Scratch cards generated successfully.',
            'scratch_cards' => $pins,
        ]);
    }

    public function index(Request $request)
    {
        $isUsed = $request->query('is_used');

        $query = ScratchCard::query();

        if (!is_null($isUsed)) {
            $isUsed = filter_var($isUsed, FILTER_VALIDATE_BOOLEAN);
            $query->where('is_used', $isUsed);
        }

        $scratchCards = $query->get();

        $pins = $scratchCards->pluck('pin');

        return response()->json([
            'scratch_cards' => $pins,
        ]);
    }
}
