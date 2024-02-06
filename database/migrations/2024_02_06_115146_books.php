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
        Schema::create("books",function(Blueprint $table){
            $table->id();
            $table->string("title");
            $table->string("publisher");
            $table->string('author');
            $table->string("genre");
            $table->date("publication")->comment("Book publication");
            $table->integer("words")->comment("Amount of words in the book");
            $table->float("price")->comment("Book price in US Dollars");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("books");
    }
};
