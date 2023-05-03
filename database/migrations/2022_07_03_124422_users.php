<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Users extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('email', 255);
            $table->string('username', 50)->unique();
            $table->text('password');
            $table->string('phone', 13);
            $table->char('country_code', 3);
            $table->ipAddress('last_ip', 14)->nullable();
            $table->boolean('is_verified')->default(0);
            $table->string('user_profile_img', 255);
            $table->text('address')->nullable();
            $table->timestamp('created_at', $precision = 0);
            // $table->foreignId('question_id')->default(1)->constrained();
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
