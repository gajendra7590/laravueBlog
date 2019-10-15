<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('company_name',100);
            $table->string('company_email',100)->unique();
            $table->string('company_address',100)->nullable();
            $table->string('company_phone',100)->nullable();
            $table->string('company_phone2',100)->nullable();
            $table->string('facebook',100)->nullable();
            $table->string('twitter',100)->nullable();
            $table->string('google',100)->nullable();
            $table->string('instagram',100)->nullable();
            $table->string('linkedin',100)->nullable();
            $table->string('pintrest',100)->nullable();
            $table->integer('default');
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
        Schema::dropIfExists('company');
    }
}
