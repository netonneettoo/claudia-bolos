<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCakeRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cake_requests', function (Blueprint $table) {
            $table->increments('id');

            $table->timestamp('delivery_timestamp');
            $table->string('cake_image')->nullable();

            $table->string('client_name');
            $table->string('client_phone')->nullable();
            $table->string('client_mobile')->nullable();

            $table->decimal('estimated_price', 8, 2);

            $table->timestamp('playment_timestamp')->nullable();
            $table->decimal('payment_value', 8, 2)->nullable();

            $table->enum('status', array('opened', 'closed', 'cancelled', 'excluded'));

            $table->text('note')->nullable();

            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();

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
        Schema::drop('cake_requests');
    }
}
