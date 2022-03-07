<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppoinmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appoinments', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->unsignedBigInteger('patient_id')->nullable();
            $table->foreign('patient_id')->references('id')->on('users')->nullOnDelete();
            $table->unsignedBigInteger('doctor_id')->nullable();
            $table->foreign('doctor_id')->references('id')->on('users')->nullOnDelete();
            $table->unsignedBigInteger('slot_id')->nullable();
            $table->foreign('slot_id')->references('id')->on('doctorslots')->nullOnDelete();
            $table->string('smoke');
            $table->string('diabetes');
            $table->string('asthma');
            $table->string('allergic');
            $table->string('diagnosed_diabetes');
            $table->string('diagnosed_heart');
            $table->string('diagnosed_kidney');
            $table->string('diagnosed_arthritis');
            $table->string('diagnosed_pulmonary');
            $table->string('diagnosed_eating');
            $table->string('complaint_name');
            $table->string('starting_date');
            $table->text('description')->nullable();
            $table->string('appoinment_type');
            $table->string('room_name');
            $table->string('status');
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
        Schema::dropIfExists('appoinments');
    }
}
