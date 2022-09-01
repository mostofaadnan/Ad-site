<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ad_posts', function (Blueprint $table) {
            $table->id();
            $table->text('date');
            $table->unsignedBigInteger('country_id');
            $table->unsignedBigInteger('state_id');
            $table->unsignedBigInteger('city_id');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('subcategory_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('feature_id')->nullable();
            $table->unsignedBigInteger('extend_day_id')->nullable();
            $table->tinyInteger('display_email')->default(0);
            $table->integer('ad_day')->default(0);
            $table->text('ending_date')->nullable();
            $table->text('title');
            $table->text('image')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->tinyInteger('details')->default(0);
            $table->tinyInteger('post_type');
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
        Schema::dropIfExists('ad_posts');
    }
}
