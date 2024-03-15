<?php

namespace App\Http\Controllers\MobileApp;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\QualityStandard;
use App\Models\Report;
use App\Models\Course;
use Illuminate\Support\Facades\Validator;

class ProfController extends Controller
{
    public function showAllStandards()
    {
        $qualitystandard = QualityStandard::paginate(1);
        return response()->json($qualitystandard, 200);
    }


    public function storeReport(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'Course Name'=>'required',
            'Success Rate' => 'required',
            'Improvement Plan' => 'required',
            'Causes of Drawbacks' => 'required',
            'Content Effectiveness' => 'required',

        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => "Sorry, the report was not stored",
                'errors' => $validator->errors()
            ], 400);
        }

        $report = Report::create($input);
        return response()->json([
            'report' => $report
        ], 201);
    }

    public function updateReport(Request $request, $id)
    {
        $report=Report::find($id);
        $input=$request->all();
        $validator = Validator::make($input, [
            'Course Name'=>'required',
            'Success Rate' => 'required',
            'Improvement Plan' => 'required',
            'Causes of Drawbacks' => 'required',
            'Content Effectiveness' => 'required',

        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => "Sorry, it's not updated",
                'errors' => $validator->errors()
            ], 422);
        }


        $report->update($input);
        return response()->json([
            'report' => $report
        ], 200);
    }


    public function showReport(string $id)
    {
        $report=Report::find($id);
        if(is_null($report)){
        return response()->json([
            'message'=>"It's not found"
        ]);
        }
    return response()->json([
        'report'=> $report
    ], 200);
    }


    public function storeCourse(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'Course Name' => 'required',
            'Academic Year'=>'required',
            'Mid' => 'required',
            'P-E' => 'required',
            'V-E' => 'required',
            'Final' => 'required',
            'Total' => 'required',
            'Description' => 'required',
            'Goals' => 'required',

        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => "Sorry, the course was not stored",
                'errors' => $validator->errors()
            ], 400);
        }

        $course = Course::create($input);
        return response()->json([
            'course' => $course
        ], 201);
    }

    public function updateCourse(Request $request, $id)
{
    $course=Course::find($id);
    $input=$request->all();
    $validator = Validator::make($input, [
        'Course Name' => 'required',
        'Academic Year'=>'required',
        'Mid' => 'required',
        'P-E' => 'required',
        'V-E' => 'required',
        'Final' => 'required',
        'Total' => 'required',
        'Description' => 'required',
        'Goals' => 'required',

    ]);

    if ($validator->fails()) {
        return response()->json([
            'message' => "Sorry, it's not updated",
            'errors' => $validator->errors()
        ], 422);
    }

    $course->update($input);
    return response()->json([
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

