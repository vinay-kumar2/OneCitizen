<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('citizens', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('aadhaar_number')->unique();
            $table->string('mobile_number');
            $table->string('email')->nullable();
            $table->string('gender');
            $table->date('date_of_birth')->nullable();
            $table->string('state');
            $table->string('district')->nullable();
            $table->text('address')->nullable();
            $table->string('pension_status');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('citizens');
    }
};
