<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('citizen_pensions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('citizen_id')->constrained('citizens')->cascadeOnDelete();
            $table->foreignId('pension_scheme_id')->constrained('pension_schemes')->cascadeOnDelete();
            $table->string('enrollment_number')->unique();
            $table->date('enrollment_date');
            $table->date('pension_start_date');
            $table->string('pension_status');
            $table->text('remarks')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('citizen_pensions');
    }
};
