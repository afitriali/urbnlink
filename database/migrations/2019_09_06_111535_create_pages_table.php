<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->char('name', 40);
			$table->char('title', 40);
			$table->json('contents')->nullable();
			$table->unsignedBigInteger('template_id')->nullable();
			$table->unsignedBigInteger('project_id');
            $table->timestamps();

			$table->foreign('template_id')->references('id')->on('templates')->onDelete('set null');
			$table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pages');
    }
}
