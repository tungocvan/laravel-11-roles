<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id(); // Khóa chính tự động tăng
            $table->unsignedBigInteger('user_id'); // ID của người tạo câu hỏi, mặc định là 1
            $table->string('category_ids'); // Chuyên mục mặc định là 1
            $table->text('question_details'); // Trường lưu nội dung câu hỏi, đáp án và đáp án đúng
            $table->enum('question_type', ['Đúng/Sai', 'Một đáp án', 'Nhiều đáp án', 'Tự luận']); // Loại câu hỏi, mặc định là "Một đáp án"
            $table->timestamps(); // Thời gian tạo và chỉnh sửa (created_at, updated_at)

            // Định nghĩa khóa ngoại cho user_id, tham chiếu đến bảng users
            // $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('questions');
    }
};
