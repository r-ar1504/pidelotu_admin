<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeliveryMenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('delivery_men', function (Blueprint $table) {
        $table->string('firebase_id',100);
        $table->primary('firebase_id');
        $table->string('name', 100);
        $table->string('last_name', 100);
        $table->string('email', 100);
        $table->string('phone', 100);
        $table->integer('status');
        $table->integer('services');
        $table->float('rating');
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
      Schema::dropIfExists('delivery_men');
    }
}
