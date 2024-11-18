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
        Schema::create('teachings', function (Blueprint $table) {
            $table->id();
            $table->text('title');
            $table->string('apogee_code', 10);
            $table->decimal('tp_hours_initial', 5, 2);
            $table->decimal('tp_hours_continued', 5, 2)->nullable();
            $table->decimal('td_hours_intial', 5, 2);
            $table->decimal('td_hours_continued', 5, 2)->nullable();
            $table->decimal('cm_hours_initial', 5, 2);
            $table->decimal('cm_hours_continued', 5, 2)->nullable();
            $table->integer('semestre')->nullable();
            $table->integer('trimestre')->nullable();
            $table->foreignId('year_id')->constrained('years')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teachings');
    }
};
