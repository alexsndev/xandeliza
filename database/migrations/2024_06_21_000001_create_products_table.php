<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->decimal('price', 10, 2);
            $table->integer('stock')->default(0);
            $table->string('image')->nullable();
            $table->foreignId('product_category_id')->constrained('product_categories')->onDelete('cascade');
            $table->boolean('is_active')->default(true);
            $table->string('mp_transaction_id')->nullable(); // Para integração Mercado Pago
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
} 