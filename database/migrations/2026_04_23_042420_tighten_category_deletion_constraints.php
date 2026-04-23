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
        // 1. Pizzas -> Categories
        Schema::table('pizzas', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
            $table->foreign('category_id')
                ->references('id')
                ->on('categories')
                ->restrictOnDelete();
        });

        // 2. Ingredients -> IngredientCategories
        Schema::table('ingredients', function (Blueprint $table) {
            $table->dropForeign(['ingredient_category_id']);
            $table->foreign('ingredient_category_id')
                ->references('id')
                ->on('ingredient_categories')
                ->restrictOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pizzas', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
            $table->foreign('category_id')
                ->references('id')
                ->on('categories')
                ->cascadeOnDelete();
        });

        Schema::table('ingredients', function (Blueprint $table) {
            $table->dropForeign(['ingredient_category_id']);
            $table->foreign('ingredient_category_id')
                ->references('id')
                ->on('ingredient_categories')
                ->cascadeOnDelete();
        });
    }
};
