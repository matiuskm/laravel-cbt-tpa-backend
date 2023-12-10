<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\QuestionResource;
use App\Models\Question;
use App\Models\Test;
use App\Models\TestQuestion;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function createTest(Request $request): JsonResponse
    {
        // get 5 random questions from each category
        $logicQuestions = Question::where('category', 'Logika')->inRandomOrder()->limit(5)->get();
        $numericQuestions = Question::where('category', 'Numeric')->inRandomOrder()->limit(5)->get();
        $verbalQuestions = Question::where('category', 'Verbal')->inRandomOrder()->limit(5)->get();

        // create test
        $test = Test::create([
            'user_id' => $request->user()->id,
        ]);

        // attach questions to test
        foreach ($logicQuestions as $question) {
            TestQuestion::create([
                'test_id' => $test->id,
                'question_id' => $question->id,
            ]);
        }

        foreach ($numericQuestions as $question) {
            TestQuestion::create([
                'test_id' => $test->id,
                'question_id' => $question->id,
            ]);
        }

        foreach ($verbalQuestions as $question) {
            TestQuestion::create([
                'test_id' => $test->id,
                'question_id' => $question->id,
            ]);
        }

        return response()->json([
            'message' => 'Test created',
            'test' => $test,
        ]);
    }

    // get question list by category
    public function getQuestionsByCategory(Request $request): JsonResponse
    {
        $test = Test::where('user_id', $request->user()->id)->latest()->first();
        if (!$test) {
            return response()->json([
                'message' => 'Test not found',
                'data' => [],
            ], 200);
        }
        $testQuestions = TestQuestion::where('test_id', $test->id)->get();
        $testQuestionId = [];
        foreach ($testQuestions as $testQuestion) {
            array_push($testQuestionId, $testQuestion->question_id);
        }
        if ($request->category)
            $questions = Question::whereIn('id', $testQuestionId)->where('category', $request->category)->get();
        else
            $questions = Question::whereIn('id', $testQuestionId)->get();
        
        return response()->json([
            'message' => 'Questions retrieved',
            'test' => $test,
            'questions' => QuestionResource::collection($questions),
        ]);
    }

    // submit answer
    public function submitAnswer(Request $request): JsonResponse {
        $validatedData = $request->validate([
            'test_id' => 'required',
            'question_id' => 'required',
            'answer' => 'required',
        ]);

        $testQuestion = TestQuestion::where('test_id', $validatedData['test_id'])->where('question_id', $validatedData['question_id'])->get();
        $question = Question::where('id', $validatedData['question_id'])->get();

        if ($question[0]->answer_1 == $validatedData['answer']) {
            $testQuestion[0]->is_correct = true;
            $testQuestion[0]->save();
        } else {
            $testQuestion[0]->is_correct = false;
            $testQuestion[0]->save();
        }

        return response()->json([
            'message' => 'Answer submitted',
            'result' => $testQuestion[0]->is_correct,
        ]);
    }
}
