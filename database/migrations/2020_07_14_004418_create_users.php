<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsers extends Migration
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
            $table->foreignId('user_type_id')->references('id')->on('users_types');
            $table->smallInteger('active')->default(0);
            $table->string('email')->unique();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('password');
            $table->string('document', 16)->unique()->comment('CPF OU CNPJ');
            $table->string('phone', 16)->nullable();
            $table->string('phone_extension', 10)->nullable();
            $table->string('cellphone', 16)->nullable();
            $table->char('sex', 1)->nullable();
            $table->boolean('newsletter')->nullable();
            $table->boolean('terms_conditions');

            $table->timestamps();
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
