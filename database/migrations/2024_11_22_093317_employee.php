<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('employee', function (Blueprint $table) {
            $table->id();
            $table->foreignId('person_id')->constrained('person')->onDelete('cascade');
            $table->string('number')->unique();
            $table->enum('employee_type', ['Assistant', 'Hygienist', 'Dentist', 'Manager']);
            $table->string('specialization')->nullable();
            $table->text('availability')->nullable();
            $table->boolean('is_active')->default(true);
            $table->text('note')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('employee');
    }
};
