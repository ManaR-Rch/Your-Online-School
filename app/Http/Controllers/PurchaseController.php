<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Purchase;
use App\Models\Course;
use Illuminate\Support\Carbon;

class PurchaseController extends Controller
{
    public function purchase(Request $request)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
        ]);
        $user = auth()->user();
        if ($user->role !== 'etudiant') {
            return response()->json(['error' => 'Seuls les étudiants peuvent acheter des cours'], 403);
        }
        $course_id = $request->course_id;
        $exists = Purchase::where('user_id', $user->id)->where('course_id', $course_id)->exists();
        if ($exists) {
            return response()->json(['error' => 'Cours déjà acheté'], 409);
        }
        $purchase = Purchase::create([
            'user_id' => $user->id,
            'course_id' => $course_id,
            'purchased_at' => Carbon::now(),
        ]);
        return response()->json(['message' => 'Achat réussi', 'purchase' => $purchase], 201);
    }
}
