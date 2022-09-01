<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->string('package_name');
            $table->integer('post_number')->nullable();
            $table->integer('image_number')->nullable();
            $table->integer('publish_day')->nullable();
            $table->boolean('image_unlimited')->nullable();
            $table->boolean('post_unlimited')->nullable();
            $table->boolean('publish_unlimited')->nullable();
            $table->float('price');
            $table->text('description')->nullable();
            $table->tinyInteger('status');
            $table->string('background_color')->nullable();
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
        Schema::dropIfExists('packages');
    }
}
