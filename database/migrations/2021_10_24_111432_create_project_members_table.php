<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_members', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id');
            $table->tinyInteger('type');
            $table->string('name');
            $table->string('email');
            $table->string('phone_number');
            $table->string('instagram');
            $table->string('facebook_link');
            $table->string('position')->nullable();
            $table->string('batch')->nullable();
            $table->year('year')->nullable();
            $table->string('state_code');
            $table->timestamps();

            $table->foreign('state_code')->references('state_code')->on('states')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('project_members');
    }
}
