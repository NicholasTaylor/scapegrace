<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('title', 200);
            $table->string('slug', 250)->unique();
            $table->string('excerpt', 200)->nullable();
            $table->text('body')->nullable();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->text('tags')->nullable();
            $table->timestamp('published_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->nullOnDelete();
            $table->foreign('category_id')->references('id')->on('categories')->nullOnDelete();

            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles');
    }
};
