<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
class Answers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('answers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('question_id')->constrained();
            $table->foreignId('user_id')->constrained();

            $table->longText('answer_synopsis');
            $table->string('attached_img', 255)->nullable();
            $table->boolean('isDeleted')->default(false);
            $table->boolean('is_ai_verified')->default(false);
            $table->timestamp('created_at', $precision = 0)->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at', $precision = 0)->default(DB::raw('CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
