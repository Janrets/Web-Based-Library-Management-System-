<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecurringInvoiceItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recurring_invoice_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('item_name')->nullable();
            $table->integer('quantity')->nullable();
            $table->float('price')->nullable();
            $table->float('total')->nullable();
            $table->tinyInteger('tax')->nullable();
            $table->integer('recurring_invoice_id')->nullable();
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
        Schema::dropIfExists('recurring_invoice_items');
    }
}
