<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientSymptomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patient_symptoms', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            // $table->bigInteger('appoinment_id')->unsigned();
            // $table->foreign('appoinment_id')->references('id')->on('medicalhistories')->onDelete('cascade');

            // $table->bigInteger('symptom_id')->unsigned();
            // $table->foreign('symptom_id')->references('id')->on('symptoms')->onDelete('cascade');
            $table->unsignedBigInteger('appoinment_id')->nullable();
            $table->foreign('appoinment_id')->references('id')->on('appoinments')->nullOnDelete();
            $table->unsignedBigInteger('symptom_id')->nullable();
            $table->foreign('symptom_id')->references('id')->on('symptoms')->nullOnDelete();
            $table->bigInteger('doctor_id')->unsigned();
            $table->foreign('doctor_id')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('patient_id')->unsigned();
            $table->foreign('patient_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('status')->default('Active');
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
        Schema::dropIfExists('patient_symptoms');
    }
}
