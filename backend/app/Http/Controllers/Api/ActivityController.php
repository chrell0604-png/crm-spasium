<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    public function index()
    {
        $activities = Activity::with('visit')->get();
        return response()->json([
            'success' => true,
            'data' => $activities
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'visit_id' => 'required|exists:visits,id',
            'activity_number' => 'required|integer|between:1,9',
        ]);

        $activity = Activity::create($request->all());
        return response()->json([
            'success' => true,
            'data' => $activity
        ], 201);
    }

    public function show($id)
    {
        $activity = Activity::with('visit')->find($id);
        if (!$activity) {
            return response()->json([
                'success' => false,
                'message' => 'Activity not found'
            ], 404);
        }
        return response()->json([
            'success' => true,
            'data' => $activity
        ]);
    }

    public function update(Request $request, $id)
    {
        $activity = Activity::find($id);
        if (!$activity) {
            return response()->json([
                'success' => false,
                'message' => 'Activity not found'
            ], 404);
        }

        $activity->update($request->all());
        return response()->json([
            'success' => true,
            'data' => $activity
        ]);
    }

    public function destroy($id)
    {
        $activity = Activity::find($id);
        if (!$activity) {
            return response()->json([
                'success' => false,
                'message' => 'Activity not found'
            ], 404);
        }
        $activity->delete();
        return response()->json([
            'success' => true,
            'message' => 'Activity deleted successfully'
        ]);
    }
}