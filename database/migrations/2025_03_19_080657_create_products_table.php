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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            // $table->string('slug')->unique();
            $table->string('sku')->unique();
            $table->string('brand');
            $table->string('model')->nullable();
            $table->string('color')->nullable();
            $table->string('size');
            $table->boolean('status')->default(1);
            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();
            $table->string('meta_image')->nullable();;
            $table->decimal('price', 8, 2);
            $table->integer('stock')->nullable();
            $table->timestamps();
        });
    }
            

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};