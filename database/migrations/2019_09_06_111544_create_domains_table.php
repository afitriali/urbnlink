<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDomainsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('domains', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->string('name')->unique();
			$table->unsignedBigInteger('project_id')->nullable();
			$table->unsignedBigInteger('default_link_id')->nullable();
            $table->unsignedBigInteger('record_id')->nullable();
			$table->string('verification_token')->nullable();
			$table->timestamp('verified_at')->nullable();
            $table->timestamps();

			$table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
			$table->foreign('default_link_id')->references('id')->on('links')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('domains');
    }
}
