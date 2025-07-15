<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Course;
use App\Models\Purchase;

class AdminController extends Controller
{
    // GET /api/admin/stats
    public function stats()
    {
        $userCount = User::count();
        $purchasesByCourse = Purchase::select('course_id')
            ->selectRaw('count(*) as total')
            ->groupBy('course_id')
            ->with('course')
            ->get();
        $topCourses = Purchase::select('course_id')
            ->selectRaw('count(*) as total')
            ->groupBy('course_id')
            ->orderByDesc('total')
            ->with('course')
            ->take(5)
            ->get();
        return response()->json([
            'user_count' => $userCount,
            'purchases_by_course' => $purchasesByCourse,
            'top_5_courses' => $topCourses,
        ]);
    }
}
