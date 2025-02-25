<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Laptop extends Model
{
    Schema::create('laptops', function (Blueprint $table) {
        $table->id();
        $table->string('brand', 50);
        $table->string('model', 100);
        $table->string('serial_number', 50)->unique();
        $table->text('specifications')->nullable();
        $table->enum('status', ['available', 'borrowed', 'defective'])->default('available');
        $table->timestamps();
    });
}
