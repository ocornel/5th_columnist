<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActionRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('action_roles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('action_id');
            $table->unsignedBigInteger('role_id');
            $table->timestamps();

            $table->foreign('action_id')->references('id')->on('actions');
            $table->foreign('role_id')->references('id')->on('roles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('action_roles');
    }
}
