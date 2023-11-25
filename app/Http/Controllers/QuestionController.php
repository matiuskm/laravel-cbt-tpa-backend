<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateQestionRequest;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // dd($request->all());
        $questions = DB::table('questions')->when($request->keyword || $request->category, function ($query) use ($request) {
            if (!empty($request->category) && !empty($request->keyword))
                return $query->where('question', 'like', "%{$request->keyword}%")
                            ->Where('category', '=', $request->category);
            else if (!empty($request->category) && empty($request->keyword))
                return $query->where('category', '=', $request->category);
            else if (empty($request->category) && !empty($request->keyword))
                return $query->where('question', 'like', "%{$request->keyword}%");
        })->paginate(10);
        return view('pages.questions.index', compact('questions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.questions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UpdateQestionRequest $request)
    {
        $data = $request->validated();
        Question::create($data);
        return redirect()->route('question.index')->with('success', 'Question created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Question $question)
    {
        return view('pages.questions.edit', compact('question'));        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateQestionRequest $request, Question $question)
    {
        $data = $request->validated();
        $question->update($data);
        return redirect()->route('question.index')->with('success', 'Question updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Question $question)
    {
        $question->delete();
        return redirect()->route('question.index')->with('success', 'Question deleted successfully.');
    }
}
