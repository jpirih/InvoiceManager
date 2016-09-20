<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateForeignCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('foreign_companies', function (Blueprint $blueprint){
            $blueprint->increments('id');
            $blueprint->string('name', 255);
            $blueprint->string('url', 255);
            $blueprint->string('logo');

            $blueprint->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('foreign_companies');
    }
}
