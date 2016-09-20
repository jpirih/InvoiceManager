<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateForeignInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('foreign_invoices', function (Blueprint $blueprint){
            $blueprint->increments('id');
            $blueprint->integer('invoice_id');
            $blueprint->integer('foreign_company_id');
            $blueprint->string('country');
            $blueprint->string('country_code', 2);

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
        Schema::drop('foreign_invoices');
    }
}
