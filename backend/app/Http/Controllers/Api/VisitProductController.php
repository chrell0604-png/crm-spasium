<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\VisitProduct;
use Illuminate\Http\Request;

class VisitProductController extends Controller
{
    public function index()
    {
        $visitProducts = VisitProduct::with(['visit', 'product'])->get();
        return response()->json([
            'success' => true,
            'data' => $visitProducts
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'visit_id' => 'required|exists:visits,id',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'nullable|integer|min:1',
        ]);

        $visitProduct = VisitProduct::create($request->all());
        return response()->json([
            'success' => true,
            'data' => $visitProduct
        ], 201);
    }

    public function show($id)
    {
        $visitProduct = VisitProduct::with(['visit', 'product'])->find($id);
        if (!$visitProduct) {
            return response()->json([
                'success' => false,
                'message' => 'Visit product not found'
            ], 404);
        }
        return response()->json([
            'success' => true,
            'data' => $visitProduct
        ]);
    }

    public function update(Request $request, $id)
    {
        $visitProduct = VisitProduct::find($id);
        if (!$visitProduct) {
            return response()->json([
                'success' => false,
                'message' => 'Visit product not found'
            ], 404);
        }

        $visitProduct->update($request->all());
        return response()->json([
            'success' => true,
            'data' => $visitProduct
        ]);
    }

    public function destroy($id)
    {
        $visitProduct = VisitProduct::find($id);
        if (!$visitProduct) {
            return response()->json([
                'success' => false,
                'message' => 'Visit product not found'
            ], 404);
        }
        $visitProduct->delete();
        return response()->json([
            'success' => true,
            'message' => 'Visit product deleted successfully'
        ]);
    }
}