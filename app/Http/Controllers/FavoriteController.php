<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;

class FavoriteController extends Controller
{
    // POST /api/favorites
    public function store(Request $request)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
        ]);
        $favorite = Favorite::firstOrCreate([
            'user_id' => auth()->id(),
            'course_id' => $request->course_id,
        ]);
        return response()->json($favorite, 201);
    }

    // GET /api/favorites
    public function index()
    {
        $favorites = Favorite::where('user_id', auth()->id())->with('course')->get();
        return response()->json($favorites);
    }
}
