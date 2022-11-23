<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoiceItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('item_name')->nullable();
            $table->integer('quantity')->nullable();
            $table->float('price')->nullable();
            $table->float('total')->nullable();
            $table->tinyInteger('tax')->nullable();


            $table->unsignedBigInteger('invoice_id');
            $table->foreign('invoice_id')->nullable()->references('id')->on('invoices');


            // $table->unsignedBigInteger('item_id');
            // $table->foreign('item_id')->nullable()->references('id')->on('items');
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoice_items');
    }
}
