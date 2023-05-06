<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

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
            $table->boolean('is_verified')->default(false);
            $table->string('user_profile_img', 255)->nullable();
            $table->text('address')->nullable();
            $table->smallInteger('user_role', 255)->default(0);//0 user, 1 admin
            $table->timestamp('created_at', $precision = 0);
        });

        DB::statement("ALTER TABLE users ADD CONSTRAINT chkrole check (user_role in (0, 1));");
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
