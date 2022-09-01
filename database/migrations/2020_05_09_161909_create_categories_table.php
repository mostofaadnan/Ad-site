<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('title')->unique();
            $table->tinyinteger('status')->default(0);
            $table->tinyInteger('post_field_type');
            $table->integer('total_free_post');
            $table->float('per_post_charge');
            $table->float('free_post_publish_day');
            $table->float('premimum_publish_day');
            $table->tinyInteger('adult_content')->default(0);
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
        Schema::dropIfExists('categories');
    }
}
