<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('about_me_works', function (Blueprint $table) {
            $table->id();
            $table->string("job");
            $table->string("company");
            $table->tinyInteger("duration_type");
            $table->string("date_start");
            $table->string("date_end");
            $table->text("description");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('about_me_works');
    }
};
