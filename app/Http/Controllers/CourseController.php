<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Purchase;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // Liste publique avec filtre par mot-clé
    public function index(Request $request)
    {
        $query = Course::query();
        if ($request->has('keyword')) {
            $keyword = $request->input('keyword');
            $query->where('title', 'like', "%$keyword%");
        }
        return $query->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'video_url' => 'nullable|string',
            'documents_url' => 'nullable|string',
        ]);
        $validated['created_by'] = auth()->id();
        $course = Course::create($validated);
        return response()->json($course, 201);
    }

    /**
     * Display the specified resource.
     */
    // Détail public d'un cours
    public function show(string $id)
    {
        $course = Course::findOrFail($id);
        return response()->json($course);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $course = Course::findOrFail($id);
        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string',
            'price' => 'sometimes|required|numeric',
            'video_url' => 'nullable|string',
            'documents_url' => 'nullable|string',
        ]);
        $course->update($validated);
        return response()->json($course);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $course = Course::findOrFail($id);
        $course->delete();
        return response()->json(['message' => 'Cours supprimé']);
    }
}
