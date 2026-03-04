<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Visitor;
use Illuminate\Http\Request;

class VisitorController extends Controller
{
    public function index()
    {
        $visitors = Visitor::with(['company', 'visits'])->get();
        return response()->json([
            'success' => true,
            'data' => $visitors
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'company_id' => 'required|exists:companies,id',
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:100',
        ]);

        $visitor = Visitor::create($request->all());
        return response()->json([
            'success' => true,
            'data' => $visitor
        ], 201);
    }

    public function show($id)
    {
        $visitor = Visitor::with(['company', 'visits'])->find($id);
        if (!$visitor) {
            return response()->json([
                'success' => false,
                'message' => 'Visitor not found'
            ], 404);
        }
        return response()->json([
            'success' => true,
            'data' => $visitor
        ]);
    }

    public function update(Request $request, $id)
    {
        $visitor = Visitor::find($id);
        if (!$visitor) {
            return response()->json([
                'success' => false,
                'message' => 'Visitor not found'
            ], 404);
        }

        $request->validate([
            'company_id' => 'sometimes|exists:companies,id',
            'name' => 'sometimes|string|max:255',
            'email' => 'nullable|email|max:100',
        ]);

        $visitor->update($request->all());
        return response()->json([
            'success' => true,
            'data' => $visitor
        ]);
    }

    public function destroy($id)
    {
        $visitor = Visitor::find($id);
        if (!$visitor) {
            return response()->json([
                'success' => false,
                'message' => 'Visitor not found'
            ], 404);
        }
        $visitor->delete();
        return response()->json([
            'success' => true,
            'message' => 'Visitor deleted successfully'
        ]);
    }
}