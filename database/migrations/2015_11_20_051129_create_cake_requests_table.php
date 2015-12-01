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

            $table->string('client_name', 45);
            $table->string('client_phone', 16)->nullable();
            $table->string('client_mobile', 16)->nullable();

            $table->decimal('estimated_price', 8, 2);

            $table->timestamp('playment_timestamp')->nullable();
            $table->decimal('payment_value', 8, 2)->nullable();

            $table->enum('status', array('opened', 'closed', 'cancelled', 'excluded'));

            $table->text('note')->nullable();

            //$table->unsignedInteger('created_by')->nullable();
            //$table->unsignedInteger('updated_by')->nullable();

            $table->timestamps();

            // relationships

            //$table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            //$table->foreign('updated_by')->references('id')->on('users')->onDelete('cascade');
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
