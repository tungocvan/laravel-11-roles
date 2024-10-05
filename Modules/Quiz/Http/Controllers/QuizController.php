<?php

namespace Modules\Quiz\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Quiz\Models\Question;
use Modules\Quiz\Models\QuestionSet;
class QuizController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function __construct()
    {
         $this->middleware('permission:quiz-list|quiz-create|quiz-edit|quiz-delete', ['only' => ['index','show']]);
         $this->middleware('permission:quiz-create', ['only' => ['create','store']]);
         $this->middleware('permission:quiz-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:quiz-delete', ['only' => ['destroy']]);
    }

    public function quizList()
    {
        $questions = Question::all();
        foreach ($questions as $question) {
            $question->parsed_details = parseQuestionDetails($question->question_details);
        }
        dd($questions);
        return view('Quiz::quiz-list',compact('questions'));
    }
    public function topicSetList()
    {
        $questions = Question::all();
        foreach ($questions as $question) {
            $question->parsed_details = parseQuestionDetails($question->question_details);
        }
        return view('Quiz::topic-set-list',compact('questions'));
    }
    public function questionSet($id)
    {

        // Lấy bộ đề theo ID
        $questionSet = QuestionSet::find($id);
        $timeRemaining = $questionSet->timeRemaining;
        // Chuyển đổi câu hỏi từ định dạng chuỗi thành mảng
        $questions = parseQuestions($questionSet->questions);
        // dd($questions);
        // $questions = Question::all();
        // foreach ($questions as $question) {
        //     $question->parsed_details = parseQuestionDetails($question->question_details);
        // }
        return view('Quiz::quiz-set',compact('questions','id','timeRemaining'));
    }

    public function submit(Request $request)
    {
        // Lấy tất cả câu hỏi
        $questions = Question::all();
        $results = [];

        foreach ($questions as $question) {
            $question->parsed_details = parseQuestionDetails($question->question_details);

            // Lấy đáp án người dùng đã chọn từ request
            $userAnswer = $request->input('question_' . $question->id);

            // Kiểm tra kết quả
            $correctAnswers = $question->parsed_details['correct_answers'];
            $isCorrect = in_array($userAnswer, $correctAnswers);

            // Lưu kết quả vào mảng results
            $results[] = [
                'question' => $question->parsed_details['content'],
                'correct' => $isCorrect,
                'user_answer' => $userAnswer,
                'correct_answers' => $correctAnswers,
                'parsed_details' => $question->parsed_details
            ];
        }

        // Trả về view kết quả
        return view('Quiz::result', ['results' => $results]);
    }
    public function submitSet(Request $request,$id)
    {
        // Lấy danh sách câu hỏi để kiểm tra đáp án
        $questionSet = QuestionSet::find($id);
        $questions = parseQuestions($questionSet->questions);

        // Đáp án đã chọn của người dùng
        $userAnswers = $request->input('answers');

        // Lưu kết quả cho mỗi câu hỏi
        $results = [];
        //dd($questions);
        foreach ($questions as $index => $question) {
            $correctAnswer = $question['correct_answer'];
            $userAnswer = isset($userAnswers[$index]) ? $userAnswers[$index] : null;

            // Kiểm tra đáp án đúng/sai
            $isCorrect = ($userAnswer == $correctAnswer);

            // Lưu kết quả
            $results[] = [
                'question' => $question['content'],
                'answers' => $question['answers'],
                'correct_answer' => $correctAnswer,
                'user_answer' => $userAnswer,
                'is_correct' => $isCorrect,
            ];
        }
        // Trả về view kết quả
        return view('Quiz::result-set', ['results' => $results]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
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
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
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
}
