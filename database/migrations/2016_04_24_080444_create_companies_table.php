<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $blueprint){
            $blueprint->increments('id');
            $blueprint->string('name', 155);
            $blueprint->string('full_name', 300);
            $blueprint->string('address', 300);
            $blueprint->string('postal_code',  10);
            $blueprint->string('city', 155);
            $blueprint->text('url');
            $blueprint->text('company_logo');
            $blueprint->string('country', 255);
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
        Schema::drop('companies');
    }
}
