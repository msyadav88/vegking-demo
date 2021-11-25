<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TransportListImported extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('transport_list_imported', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('reference')->nullable();
            $table->string('loading_date')->nullable();
            $table->string('unloading_date')->nullable();
            $table->string('consignorloadercustomer')->nullable();
            $table->string('loading_point')->nullable();
            $table->string('unloading_point')->nullable();
            $table->string('customer')->nullable();
            $table->string('gross_weight')->nullable();
            $table->string('nett_weight')->nullable();
            $table->string('unloaded_weight')->nullable();
            $table->string('payweight')->nullable();
            $table->string('diff')->nullable();
            $table->string('no_pack')->nullable();
            $table->string('temp')->nullable();
            $table->string('kind_of_trailer')->nullable();
            $table->string('truck_plates')->nullable();
            $table->string('container_no')->nullable();
            $table->string('load_eta')->nullable();
            $table->string('del_eta')->nullable();
            $table->string('driver_phone_number')->nullable();
            $table->string('carrier')->nullable();
            $table->string('variety')->nullable();
            $table->string('kind_of_cargo')->nullable();
            $table->string('kind_of_payment_for_transport')->nullable();
            $table->string('transport_cost')->nullable();
            $table->string('pln_transport')->nullable();
            $table->string('notices')->nullable();
            $table->string('cmr')->nullable();
            $table->string('transport_invoice')->nullable();
            $table->string('transport_invoice_uk')->nullable();
            $table->string('sales_invoice')->nullable();
            $table->string('sales_price')->nullable();
            $table->string('payment_period')->nullable();
            $table->string('purchase_invoice')->nullable();
            $table->string('paid')->nullable();
            $table->string('purchase_rate')->nullable();
            $table->string('date_od_purchase_invoice')->nullable();
            $table->string('transport_payment_term')->nullable();
            $table->string('carrier_documents')->nullable();
            $table->string('order')->nullable();
            $table->string('status')->nullable();
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
        //
        Schema::dropIfExists('transport_list_imported');
    }
}
