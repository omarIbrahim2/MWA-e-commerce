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
            $table->foreignId('item_name')->constrained();
            $table->string('code')->primary();
            $table->string('name');
            $table->text('desc')->nullable();
            $table->string('color')->nullable();
            $table->string('dimension')->nullable();
            $table->unsignedInteger('cc')->nullable();
            $table->float('weight' , 3 , 2 , true)->nullable();
            $table->float('price' , 6 , 2 , true);
            $table->float('percentage' , 1 , 3 , true);
            $table->string('img')->nullable();
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
