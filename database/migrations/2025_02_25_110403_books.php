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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('author');
            $table->string('publisher')->nullable();
            $table->foreignId('genre_id')->nullable()->constrained('genres')->onDelete('set null');
            $table->integer('year_published')->nullable();
            $table->text('description')->nullable();
            $table->enum('status', ['available', 'borrowed'])->default('available');
            $table->integer('loan_period')->default(21);
            $table->timestamps();
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
