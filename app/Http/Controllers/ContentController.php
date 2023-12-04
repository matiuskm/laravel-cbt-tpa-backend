<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateContentRequest;
use App\Models\Content;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $contents = DB::table('contents')->when($request->keyword, function ($query) use ($request) {
            return $query->where('section', 'like', "%{$request->keyword}%")
                ->orWhere('content', 'like', "%{$request->keyword}%");
        })->orderBy('id', 'desc')->paginate(10);
        return view('pages.contents.index', compact('contents'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.contents.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateContentRequest $request)
    {
        $data = $request->validated();
        Content::create($data);
        return redirect()->route('content.index')->with('success', 'Content created successfully.');        
    }

    /**
     * Display the specified resource.
     */
    public function show(Content $content)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Content $content)
    {
        return view('pages.contents.edit', compact('content')); 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CreateContentRequest $request, Content $content)
    {
        $data = $request->validated();
        $content->update($data);
        return redirect()->route('content.index')->with('success', 'Content created successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Content $content)
    {
        $content->delete();
        return redirect()->route('content.index')->with('success', 'Content deleted successfully.');
    }

    public function showAboutUs(): JsonResponse {
        $content = Content::select('content')->where('section', '=', 'aboutus')->first();
        return response()->json([
            'status' => 'success',
            'data' => strip_tags($content['content'])
        ]);
    }
}
