<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CancelReason;
use Illuminate\Http\Request;

class CancelReasonController extends Controller
{
    public function index()
    {
        $reasons = CancelReason::with('company')->get();
        return response()->json([
            'success' => true,
            'data' => $reasons
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'company_id' => 'required|exists:companies,id',
            'reason' => 'required|string|max:255',
        ]);

        $reason = CancelReason::create($request->all());
        return response()->json([
            'success' => true,
            'data' => $reason
        ], 201);
    }

    public function show($id)
    {
        $reason = CancelReason::with('company')->find($id);
        if (!$reason) {
            return response()->json([
                'success' => false,
                'message' => 'Cancel reason not found'
            ], 404);
        }
        return response()->json([
            'success' => true,
            'data' => $reason
        ]);
    }

    public function update(Request $request, $id)
    {
        $reason = CancelReason::find($id);
        if (!$reason) {
            return response()->json([
                'success' => false,
                'message' => 'Cancel reason not found'
            ], 404);
        }

        $reason->update($request->all());
        return response()->json([
            'success' => true,
            'data' => $reason
        ]);
    }

    public function destroy($id)
    {
        $reason = CancelReason::find($id);
        if (!$reason) {
            return response()->json([
                'success' => false,
                'message' => 'Cancel reason not found'
            ], 404);
        }
        $reason->delete();
        return response()->json([
            'success' => true,
            'message' => 'Cancel reason deleted successfully'
        ]);
    }
}