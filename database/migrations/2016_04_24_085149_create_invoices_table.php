<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $blueprint){
            $blueprint->increments('id');
            $blueprint->string('invoice_nr', 255);
            $blueprint->date('invoice_date');
            $blueprint->integer('company_id');
            $blueprint->integer('payment_instrument_id');
            $blueprint->float('total');
            $blueprint->boolean('deleted')->default(false);
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
        Schema::drop('invoices');
    }
}
