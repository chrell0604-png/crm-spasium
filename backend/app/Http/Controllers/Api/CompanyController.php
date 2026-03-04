<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index()
    {
        $companies = Company::all();
        return response()->json([
            'success' => true,
            'data' => $companies
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|unique:companies,code|max:50',
        ]);

        $company = Company::create($request->all());
        return response()->json([
            'success' => true,
            'data' => $company
        ], 201);
    }

    public function show($id)
    {
        $company = Company::with(['visitors', 'products', 'visits'])->find($id);
        if (!$company) {
            return response()->json([
                'success' => false,
                'message' => 'Company not found'
            ], 404);
        }
        return response()->json([
            'success' => true,
            'data' => $company
        ]);
    }

    public function update(Request $request, $id)
    {
        $company = Company::find($id);
        if (!$company) {
            return response()->json([
                'success' => false,
                'message' => 'Company not found'
            ], 404);
        }

        $request->validate([
            'name' => 'sometimes|string|max:255',
            'code' => 'sometimes|string|unique:companies,code,' . $id . '|max:50',
        ]);

        $company->update($request->all());
        return response()->json([
            'success' => true,
            'data' => $company
        ]);
    }

    public function destroy($id)
    {
        $company = Company::find($id);
        if (!$company) {
            return response()->json([
                'success' => false,
                'message' => 'Company not found'
            ], 404);
        }
        $company->delete();
        return response()->json([
            'success' => true,
            'message' => 'Company deleted successfully'
        ]);
    }
}