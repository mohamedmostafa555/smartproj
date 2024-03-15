<?php

namespace App\Http\Controllers\MobileApp;
use App\Http\Controllers\Controller;
use App\Models\QualityStandard;
use App\Models\Course;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function showAllStandards()
    {
        $qualitystandard = QualityStandard::paginate(1);
        return response()->json($qualitystandard, 200);
    }

    public function showAllCourses()
    {
        $academicYear = Course::pluck('Academic Year')->first();
        $course = Course::pluck('Course Name');

        return response()->json([
            'academicYear'=>$academicYear,
            'course' => $course
        ], 200);
    }
    public function showCourse(string $id)
    {
        $academicYear = Course::pluck('Academic Year')->first();
        $course = Course::select('Course Name', 'Mid', 'P-E', 'V-E', 'Final', 'Total', 'Description', 'Goals')
            ->find($id);

        if (is_null($course)) {
            return response()->json([
                'message' => "It's not found"
            ]);
        }

        return response()->json([
            'academic_year' => $academicYear,
            'course' => $course
        ], 200);
    }

}
