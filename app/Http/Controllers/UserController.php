<?php

namespace App\Http\Controllers;

use App\Models\ScratchCard;
use App\Models\Result;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function checkResult(Request $request)
    {
        $this->validate($request, [
            'user_id' => 'nullable|integer',
            'pin' => 'required|string|size:19',
        ]);

        $userId = $request->input('user_id') ?? Auth::id();
        $pin = strtoupper($request->input('pin'));

        $scratchCard = ScratchCard::where('pin', $pin)->first();

        if (!$scratchCard || $scratchCard->is_used) {
            return response()->json([
                'message' => 'Invalid or already used scratch card.',
            ], 404);
        }

        $scratchCard->update(['is_used' => true]);

        // Retrieve all results for the authenticated user
        $results = Result::where('user_id', $userId)->get();

        if ($results->isEmpty()) {
            return response()->json([
                'message' => 'No results found for this user.',
            ], 404);
        }

        // Prepare results in the desired format
        $resultData = $results->map(function ($result) {
            return [
                'subject' => $result->subject,
                'score' => $result->score,
                'total_marks' => $result->total_marks,
            ];
        });

        return response()->json([
            'pin' => $scratchCard->pin,
            'results' => $resultData,
        ]);
    }
}
