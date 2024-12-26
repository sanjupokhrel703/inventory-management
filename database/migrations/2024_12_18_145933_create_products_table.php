<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key
            $table->string('name')->unique(); // Product name column
            $table->unsignedBigInteger('category_id')->default(1);
            $table->integer('quantity')->default(0);
            // Quantity with two decimal places
            $table->decimal('price', 10, 2); // Price with two decimal places
            $table->timestamps(); // Created at and updated at columns

            $table->foreign('category_id')->references('id')->on('categories');
        });

    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
}
