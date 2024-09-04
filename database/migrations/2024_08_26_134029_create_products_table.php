<?php

use App\Models\Category;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Category::class)->default('1');
            $table->timestamps();
            $table->string('name');
            $table->text('description');
            $table->string('photo')->default('/photos/no-image.png');
            $table->string('price');
            $table->string('discount_price')->nullable();
            $table->boolean('availability')->default(true);


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
