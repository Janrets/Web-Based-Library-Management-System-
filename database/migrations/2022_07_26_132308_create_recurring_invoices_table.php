<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecurringInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recurring_invoices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('customer_name')->nullable();
            $table->tinyInteger('currency')->nullable();
            $table->text('address')->nullable();
            $table->string('invoice_prefix')->nullable();
            $table->string('recurring_invoice_no')->nullable();
            $table->date('invoice_date')->nullable();
            $table->integer('payment_terms')->nullable();
            $table->tinyInteger('sales_tax')->nullable();
            $table->float('grand_total')->nullable();
            $table->tinyInteger('status')->nullable();
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
        Schema::dropIfExists('recurring_invoices');
    }
}
