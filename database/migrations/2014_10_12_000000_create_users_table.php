<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('contact')->nullable();
            $table->string('gender')->nullable();
            $table->string('address')->nullable();
            $table->string('date_of_birth')->nullable();
            $table->string('medical_record')->nullable();
            $table->string('medical_record_url')->nullable();
            $table->string('emergencey_contact')->nullable();
            $table->string('type')->nullable();
            $table->bigInteger('cat_id')->unsigned()->nullable();
            $table->foreign('cat_id')->references('id')->on('categories')->onDelete('cascade');
            $table->string('social_id')->unique()->nullable();
            $table->text('fcm_token')->nullable();
            $table->string('image')->nullable();
            $table->string('url')->nullable();
            $table->text('description')->nullable();
            $table->text('hospital_name')->nullable();
            $table->text('work_experience')->nullable();
            $table->string('education')->nullable();
            $table->string('fees')->nullable();
            $table->string('status')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
