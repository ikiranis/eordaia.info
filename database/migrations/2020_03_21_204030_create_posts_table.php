<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('slug');
            $table->uuid('user_id')->nullable();
            $table->string('title');
            $table->text('description')->nullable();
            $table->longText('body');
            $table->string('reference', 800)->nullable();
            $table->boolean('approved')->default(false);
            $table->string('author')->nullable();
            $table->timestamps();
            $table->primary('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
