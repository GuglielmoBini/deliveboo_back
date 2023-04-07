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
        Schema::create('restaurants', function (Blueprint $table) {
            $table->id();
            // TODO
            $table->foreignId('user_id')->nullOnDelete()->constrained();
            $table->string('address');
            $table->string('name', 50);
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->string('rating')->nullable(); //rating will be printed front-office
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('restaurants');
    }
};
