<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBizpostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bizposts', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('slug');
            $table->string('title');
            $table->longText('body');
            $table->boolean('activated')->default(false);
            $table->boolean('validated')->default(false);
            $table->tinyInteger('kind');
            $table->uuid('business_id')->nullable();
            $table->date('due_date');
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
        Schema::dropIfExists('bizposts');
    }
}
