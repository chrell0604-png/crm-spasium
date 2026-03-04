<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\VisitLocation;
use Illuminate\Http\Request;

class VisitLocationController extends Controller
{
    public function index()
    {
        $visitLocations = VisitLocation::with(['visit', 'projectLocation'])->get();
        return response()->json([
            'success' => true,
            'data' => $visitLocations
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'visit_id' => 'required|exists:visits,id',
            'project_location_id' => 'required|exists:project_locations,id',
        ]);

        $visitLocation = VisitLocation::create($request->all());
        return response()->json([
            'success' => true,
            'data' => $visitLocation
        ], 201);
    }

    public function show($id)
    {
        $visitLocation = VisitLocation::with(['visit', 'projectLocation'])->find($id);
        if (!$visitLocation) {
            return response()->json([
                'success' => false,
                'message' => 'Visit location not found'
            ], 404);
        }
        return response()->json([
            'success' => true,
            'data' => $visitLocation
        ]);
    }

    public function update(Request $request, $id)
    {
        $visitLocation = VisitLocation::find($id);
        if (!$visitLocation) {
            return response()->json([
                'success' => false,
                'message' => 'Visit location not found'
            ], 404);
        }

        $visitLocation->update($request->all());
        return response()->json([
            'success' => true,
            'data' => $visitLocation
        ]);
    }

    public function destroy($id)
    {
        $visitLocation = VisitLocation::find($id);
        if (!$visitLocation) {
            return response()->json([
                'success' => false,
                'message' => 'Visit location not found'
            ], 404);
        }
        $visitLocation->delete();
        return response()->json([
            'success' => true,
            'message' => 'Visit location deleted successfully'
        ]);
    }
}