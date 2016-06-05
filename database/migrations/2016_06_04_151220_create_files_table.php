<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files', function (Blueprint $blueprint){
            $blueprint->increments('id');
            $blueprint->integer('attachment_id');
            $blueprint->string('file_name');
            $blueprint->float('file_size');
            $blueprint->string('file_type');
            $blueprint->string('file_path');
          
            
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
        Schema::drop('files');
    }
}
