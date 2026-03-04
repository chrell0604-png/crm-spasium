<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\VisitCancel;
use Illuminate\Http\Request;

class VisitCancelController extends Controller
{
    public function index()
    {
        $visitCancels = VisitCancel::with(['visit', 'cancelReason'])->get();
        return response()->json([
            'success' => true,
            'data' => $visitCancels
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'visit_id' => 'required|exists:visits,id',
            'cancel_reason_id' => 'required|exists:cancel_reasons,id',
        ]);

        $visitCancel = VisitCancel::create($request->all());
        return response()->json([
            'success' => true,
            'data' => $visitCancel
        ], 201);
    }

    public function show($id)
    {
        $visitCancel = VisitCancel::with(['visit', 'cancelReason'])->find($id);
        if (!$visitCancel) {
            return response()->json([
                'success' => false,
                'message' => 'Visit cancel not found'
            ], 404);
        }
        return response()->json([
            'success' => true,
            'data' => $visitCancel
        ]);
    }

    public function update(Request $request, $id)
    {
        $visitCancel = VisitCancel::find($id);
        if (!$visitCancel) {
            return response()->json([
                'success' => false,
                'message' => 'Visit cancel not found'
            ], 404);
        }

        $visitCancel->update($request->all());
        return response()->json([
            'success' => true,
            'data' => $visitCancel
        ]);
    }

    public function destroy($id)
    {
        $visitCancel = VisitCancel::find($id);
        if (!$visitCancel) {
            return response()->json([
                'success' => false,
                'message' => 'Visit cancel not found'
            ], 404);
        }
        $visitCancel->delete();
        return response()->json([
            'success' => true,
            'message' => 'Visit cancel deleted successfully'
        ]);
    }
}