<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Visit;
use Illuminate\Http\Request;

class VisitController extends Controller
{
    public function index()
    {
        $visits = Visit::with(['company', 'visitor', 'visitProducts.product', 'visitLocations.projectLocation', 'activities'])->get();
        return response()->json([
            'success' => true,
            'data' => $visits
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'company_id' => 'required|exists:companies,id',
            'visitor_id' => 'required|exists:visitors,id',
            'visit_date' => 'required|date',
            'status' => 'nullable|string|max:50',
        ]);

        $visit = Visit::create($request->all());
        return response()->json([
            'success' => true,
            'data' => $visit
        ], 201);
    }

    public function show($id)
    {
        $visit = Visit::with(['company', 'visitor', 'visitProducts.product', 'visitLocations.projectLocation', 'activities'])->find($id);
        if (!$visit) {
            return response()->json([
                'success' => false,
                'message' => 'Visit not found'
            ], 404);
        }
        return response()->json([
            'success' => true,
            'data' => $visit
        ]);
    }

    public function update(Request $request, $id)
    {
        $visit = Visit::find($id);
        if (!$visit) {
            return response()->json([
                'success' => false,
                'message' => 'Visit not found'
            ], 404);
        }

        $visit->update($request->all());
        return response()->json([
            'success' => true,
            'data' => $visit
        ]);
    }

    public function destroy($id)
    {
        $visit = Visit::find($id);
        if (!$visit) {
            return response()->json([
                'success' => false,
                'message' => 'Visit not found'
            ], 404);
        }
        $visit->delete();
        return response()->json([
            'success' => true,
            'message' => 'Visit deleted successfully'
        ]);
    }
}