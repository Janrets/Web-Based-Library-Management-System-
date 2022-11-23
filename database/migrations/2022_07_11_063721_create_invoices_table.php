<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
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
        Schema::create('invoices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('customer_name')->nullable();
            $table->tinyInteger('currency')->nullable();
            $table->text('address')->nullable();
            $table->string('invoice_prefix')->nullable();
            $table->string('invoice_no')->nullable();
            $table->date('invoice_date')->nullable();
            $table->integer('payment_terms')->nullable();
            $table->tinyInteger('sales_tax')->nullable();
            $table->float('grand_total')->nullable();
            $table->tinyInteger('status')->nullable();



            // $table->unsignedBigInteger('customer_id');
            // $table->foreign('customer_id')->nullable()->references('id')->on('customers');
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
        Schema::dropIfExists('invoices');
    }
}
