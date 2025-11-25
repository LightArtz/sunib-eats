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
        Schema::create('reviews', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->foreignId('restaurant_id')->constrained()->onDelete('cascade');
        
        $table->text('content'); 
        $table->unsignedTinyInteger('rating'); 
        
        $table->unsignedBigInteger('price_per_portion')->nullable(); 
        $table->unsignedTinyInteger('price_symbol_count')->nullable(); 
        
        $table->timestamp('edited_at')->nullable();
        $table->json('edit_history')->nullable(); 
        
        $table->timestamps();
        $table->softDeletes();
        
        $table->unique(['user_id', 'restaurant_id']);
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
