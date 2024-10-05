<?php

use Illuminate\Support\Facades\Route;
use Modules\Quiz\Http\Controllers\QuizController;

Route::middleware(['web','auth'])->prefix('/admin')->name('quiz.')->group(function(){
    Route::get('/quiz-list', [QuizController::class,'quizList'])->name('quiz-list'); 
    Route::get('/topic-set-list', [QuizController::class,'topicSetList'])->name('topic-set-list'); 
    Route::get('/question-set/{id}', [QuizController::class,'questionSet'])->name('question-set');
    Route::post('/submit', [QuizController::class,'submit'])->name('submit');
    Route::post('/submit-set/{id}', [QuizController::class,'submitSet'])->name('submit-set');
});
