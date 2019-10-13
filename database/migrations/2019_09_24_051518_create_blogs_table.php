<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('blog_name')->nullable($value = true);
            $table->string('blog_title')->nullable($value = true);
            $table->longText('blog_desc')->nullable($value = true); 
            $table->string('blog_url'); 
            $table->bigInteger('blog_user'); 
            $table->bigInteger('blog_category')->nullable($value = true);
            $table->string('blog_image')->nullable($value = true);
            $table->string('blog_location')->nullable($value = true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blogs');
    }
}
