<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name', 30);
            $table->string('last_name', 30);
            $table->text('email');
            $table->string('emailsig', 30)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('phone');
            $table->unsignedTinyInteger('age');
            $table->boolean('gender');
            $table->string('country');
            $table->string('state');
            $table->string('city');
            $table->unsignedTinyInteger('how_much_save')->nullable();
            $table->string('section')->nullable();
            $table->string('image')->nullable();
            $table->json('reads_save')->nullable();
            $table->json('reads_learning')->nullable();
            $table->text('information')->nullable();
            $table->double('rate', 3, 2)->default(0);
            $table->unsignedTinyInteger('minutes')->default(0);
            $table->unsignedTinyInteger('money')->default(0);
            $table->unsignedTinyInteger('price_of_minute')->default(0);
            $table->time('from')->nullable();
            $table->time('to')->nullable();
            $table->string('vf_cash')->nullable();
            $table->string('bank_account')->nullable();
            $table->string('name_of_bank')->nullable();
            $table->string('national_id')->nullable();
            $table->string('id_photo')->nullable();
            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('google')->nullable();
            $table->string('ip', 45);
            $table->string('timezone', 64);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
