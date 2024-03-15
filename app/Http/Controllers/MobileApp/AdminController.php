<?php

namespace App\Http\Controllers\MobileApp;

use App\Http\Controllers\Controller;
use App\Models\QualityStandard;
use App\Models\Report;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function showAllStandards()
    {
        $qualitystandard = QualityStandard::paginate(1);
        return response()->json($qualitystandard, 200);
    }


    public function storeQualityStandard(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'image' => 'required|image',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => "Sorry, the quality standard couldn't be stored",
                'errors' => $validator->errors()
            ], 400);
        }

        $input =$request->all();
        if ($image = $request->file('image')){
            $destinationPath = 'images/';
            $profileImage = date('YmdHis').'.'.$image->getClientOriginalExtension();
            $image->move($destinationPath,$profileImage);
            $input['image'] = $profileImage;

        $qualityStandard = QualityStandard::create($input);

        return response()->json([
            'qualityStandard' => $qualityStandard
        ], 201);
        }
    }

    public function updateQualityStandard(Request $request, $id)
    {
        $qualityStandard=QualityStandard::find($id);
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'image' => 'image',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => "Sorry, the quality standard couldn't be updated",
                'errors' => $validator->errors()
            ], 400);
        }

        $input = $request->all();
        if ($image = $request->file('image')){
            $destinationPath = 'images/';
            $profileImage = date('YmdHis').'.'.$image->getClientOriginalExtension();
            $image->move($destinationPath,$profileImage);
            $input['image'] = $profileImage;
        } else {
            unset($input['image']);
        }

        $qualityStandard->update($input);
        return response()->json([
            'qualitystandard' => $qualityStandard
        ], 200);
    }

    public function destroyQualityStandard($id)
    {
        $qualitystandard = QualityStandard::find($id);
        if (is_null($qualitystandard)) {
            return response()->json([
                'message' => "Quality standard not found"
            ], 404);
        }

        $qualitystandard->delete();
        return response()->json([
            'qualitystandard' => $qualitystandard
        ], 200);
    }

    public function showAllReports()
    {
        $report = Report::pluck('Course Name');
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

        $user = auth()->user();
        $name = $user->name;
    return response()->json([
        "By :" => $name,
        'report'=> $report
    ], 200);
    }

    public function showAllCourses()
    {
        $course = Course::pluck('Course Name');

        return response()->json([
            'course' => $course
        ], 200);
    }

    public function showCourse(string $id)
    {
        $course=Course::find($id);
        if(is_null($course)){
        return response()->json([
            'message'=>"It's not found"
        ]);
        }

        $user = auth()->user();
        $name = $user->name;
        return response()->json([
            "By :" => $name,
            'course'=> $course
        ], 200);
    }
}
