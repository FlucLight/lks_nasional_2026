<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('trash_scans', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->string('object_name');
            $table->string('category');
            $table->integer('score');
            $table->longText('thumbnail')->nullable();
            $table->boolean('is_permanent')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('trash_scans');
    }
};
