<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('teacher_id')->nullable()->constrained('users')->onDelete('set null');
            $table->enum('type', ['save', 'check', 'learn']);
            $table->unsignedSmallInteger('time');
            $table->text('teacher_report')->nullable();
            $table->unsignedTinyInteger('teacher_rate')->nullable();
            $table->unsignedTinyInteger('student_rate')->nullable();
            $table->enum('status', ['open', 'end']);
            $table->timestamps();

            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('rooms');
    }
}
