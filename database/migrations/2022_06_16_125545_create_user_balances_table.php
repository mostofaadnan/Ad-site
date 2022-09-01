<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserBalancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_balances', function (Blueprint $table) {
            $table->id();
            $table->unsignedTinyInteger('user_id');
            $table->text('description');
            $table->float('credit');
            $table->float('debit');
            $table->text('payment_description')->nullable();
            $table->text('transection')->nullable();
            $table->string('currency')->nullable();
            $table->string('Method')->nullable();
            $table->string('address')->nullable();
            $table->text('status')->nullable();
            $table->tinyInteger('cancel');
           
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
        Schema::dropIfExists('user_balances');
    }
}
