<?php

namespace App\Http\Controllers;

use App\Models\ScratchCard;
use App\Models\User;
use App\Models\Result;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function generate(Request $request)
    {
        $this->validate($request, [
            'count' => 'required|integer|min:1|max:1000',
        ]);

        $count = $request->query('count') ?? 1;

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

    public function getUsers(Request $request)
    {
        $users = User::all();

        return response()->json([
            'users' => $users,
        ]);
    }

    public function getAccountTypes()
    {
        $accountTypes = DB::table('account_types')->get();

        return response()->json(
            $accountTypes
        );
    }

    // Method to create a result for a user
    public function createResult(Request $request)
    {
        $this->validate($request, [
            'user_id' => 'required|exists:users,id',
            'subject' => 'required|string',
            'score' => 'required|integer',
            'total_marks' => 'required|integer',
        ]);

        // Create a new result for the specified user
        $result = Result::create([
            'user_id' => $request->input('user_id'),
            'subject' => $request->input('subject'),
            'score' => $request->input('score'),
            'total_marks' => $request->input('total_marks'),
        ]);

        return response()->json([
            'message' => 'Result created successfully.',
            'result' => $result,
        ]);
    }
}
