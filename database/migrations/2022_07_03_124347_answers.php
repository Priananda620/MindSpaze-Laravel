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
            // $table->boolean('isDeleted')->default(false);
            $table->softDeletes();
            $table->boolean('ai_classification_status')->nullable();
            $table->boolean('moderated_as')->nullable();
            $table->timestamp('created_at', $precision = 0)->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at', $precision = 0)->default(DB::raw('CURRENT_TIMESTAMP'));
        });

        DB::statement("ALTER TABLE `answers` CHANGE `updated_at` `updated_at` TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP;");
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
