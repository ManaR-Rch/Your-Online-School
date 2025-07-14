<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Progression;

class ProgressionController extends Controller
{
    // PATCH /api/progressions
    public function update(Request $request)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'percent_done' => 'required|integer|min:0|max:100',
        ]);
        $progression = Progression::updateOrCreate(
            [
                'user_id' => auth()->id(),
                'course_id' => $request->course_id,
            ],
            [
                'percent_done' => $request->percent_done,
            ]
        );
        return response()->json($progression);
    }

    // GET /api/progressions
    public function index()
    {
        $progressions = Progression::where('user_id', auth()->id())->get();
        return response()->json($progressions);
    }
}
