<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateMaterialRequest;
use App\Models\Material;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $materials = Material::when($request->keyword, function ($query) use ($request) {
            return $query->where('content', 'like', "%{$request->keyword}%");
        })->paginate(10);

        return view('pages.materials.index', compact('materials'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.materials.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateMaterialRequest $request)
    {
        $data = $request->validated();
        Material::create($data);

        return redirect()->route('material.index')->with('success', 'Material created successfully.');        
    }

    /**
     * Display the specified resource.
     */
    public function show(Material $material)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Material $material)
    {
        return view('pages.materials.edit', compact('material'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CreateMaterialRequest $request, Material $material)
    {
        $data = $request->validated();
        $material->update($data);
        return redirect()->route('material.index')->with('success', 'Material updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Material $material)
    {
        $material->delete();
        return redirect()->route('material.index')->with('success', 'Material deleted successfully.');
    }

    public function getMaterials(Request $request): JsonResponse {
        $materials = Material::all();
        foreach ($materials as $material)
            $material['content'] = strip_tags($material['content']);
        if ($materials)
            return response()->json(['status' => 'success', 'data' => $materials], 200);
        else
            return response()->json(['status' => 'not found'], 404);
    }

    public function getMaterial(Request $request): JsonResponse {
        $material = Material::where('id', '=', $request->id)->first();
        $material['content'] = strip_tags($material['content']);
        if ($material)
            return response()->json(['status' => 'success', 'data' => $material], 200);
        else
            return response()->json(['status' => 'not found'], 404);
    }
}
