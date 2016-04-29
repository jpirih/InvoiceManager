<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $blueprint) {
            $blueprint->increments('id');
            $blueprint->integer('invoice_id');
            $blueprint->string('name', 255);
            $blueprint->integer('unit_id');
            $blueprint->decimal('quantity');
            $blueprint->decimal('unit_price');
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
        Schema::drop('items');
    }
}
