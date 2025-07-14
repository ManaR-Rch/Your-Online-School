<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Note;

class NoteController extends Controller
{
    // POST /api/notes
    public function store(Request $request)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'content' => 'required|string',
        ]);
        $note = Note::create([
            'user_id' => auth()->id(),
            'course_id' => $request->course_id,
            'content' => $request->content,
        ]);
        return response()->json($note, 201);
    }

    // GET /api/notes
    public function index()
    {
        $notes = Note::where('user_id', auth()->id())->get();
        return response()->json($notes);
    }
}
