<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ProjectLocation;
use Illuminate\Http\Request;

class ProjectLocationController extends Controller
{
    public function index()
    {
        $locations = ProjectLocation::with('company')->get();
        return response()->json([
            'success' => true,
            'data' => $locations
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'company_id' => 'required|exists:companies,id',
            'name' => 'required|string|max:255',
        ]);

        $location = ProjectLocation::create($request->all());
        return response()->json([
            'success' => true,
            'data' => $location
        ], 201);
    }

    public function show($id)
    {
        $location = ProjectLocation::with('company')->find($id);
        if (!$location) {
            return response()->json([
                'success' => false,
                'message' => 'Location not found'
            ], 404);
        }
        return response()->json([
            'success' => true,
            'data' => $location
        ]);
    }

    public function update(Request $request, $id)
    {
        $location = ProjectLocation::find($id);
        if (!$location) {
            return response()->json([
                'success' => false,
                'message' => 'Location not found'
            ], 404);
        }

        $location->update($request->all());
        return response()->json([
            'success' => true,
            'data' => $location
        ]);
    }

    public function destroy($id)
    {
        $location = ProjectLocation::find($id);
        if (!$location) {
            return response()->json([
                'success' => false,
                'message' => 'Location not found'
            ], 404);
        }
        $location->delete();
        return response()->json([
            'success' => true,
            'message' => 'Location deleted successfully'
        ]);
    }
}