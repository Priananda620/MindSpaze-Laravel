<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Questions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();

            $table->string('title', 255);
            $table->longText('question_synopsis');
            $table->string('attached_img', 255)->nullable();
            $table->boolean('isHotThread')->default(false);
            $table->boolean('isDeleted')->default(false);
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
