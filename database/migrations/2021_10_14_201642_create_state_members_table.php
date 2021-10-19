<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('state_members', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->onDelete('cascade');
            $table->string('name');
            $table->string('email');
            $table->string('phone_number', 16);
            $table->string('instagram')->nullable();
            $table->string('facebook')->nullable();
            $table->string('position')->nullable();
            $table->tinyInteger('type');
            $table->string('batch');
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
        Schema::dropIfExists('state_members');
    }
}
