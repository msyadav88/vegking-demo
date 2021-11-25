<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('stocks')) {
            Schema::create('stocks', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->bigInteger('seller_id')->unsigned()->index();
                $table->bigInteger('product_id')->unsigned()->index();
                $table->string('size_from')->nullable();
                $table->string('size_to')->nullable();
                $table->string('quantity')->nullable();
                $table->text('postalcode')->nullable();
                $table->text('street')->nullable();
                $table->text('country')->nullable();
                $table->float('price')->nullable();
                $table->string('price_currency')->nullable();
                $table->string('image')->nullable();
                $table->enum('status', array('New', 'Pending', 'Processing', 'Declined', 'Sale'))->default('New');
                $table->bigInteger('city')->default(0);
                $table->enum('stock_status', array('unavailable', 'available','upcoming_stock'))->nullable()->default(null);
                $table->enum('load_status', array('ready_for_collection', 'unplanned','planned','loaded','unloaded','in_store','rejected','other'))->nullable()->default(null);
                $table->integer('available_per_day')->nullable();
                $table->date('available_from_date')->nullable();
                $table->integer('purpose')->nullable();
                $table->integer('defects')->nullable();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stock');
    }
}
