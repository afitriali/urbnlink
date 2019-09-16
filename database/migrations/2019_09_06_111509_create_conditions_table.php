<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConditionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conditions', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->unsignedBigInteger('alternative_link_id');
			$table->unsignedBigInteger('condition_type_id');
			$table->json('values');
            $table->timestamps();

			$table->foreign('alternative_link_id')->references('id')->on('alternative_links')->onDelete('cascade');
			$table->foreign('condition_type_id')->references('id')->on('condition_types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('conditions');
    }
}
