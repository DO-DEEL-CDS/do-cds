<?php

use App\Enums\ProspectStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProspectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prospects', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique()->index();
            $table->string('nysc_state_code', 20)->unique()->index();
            $table->string('state_code')->nullable();
            $table->string('verify_token', 6)->nullable();
            $table->mediumText('intro_video')->nullable();
            $table->tinyInteger('status')->default(ProspectStatus::Pending);
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
        Schema::dropIfExists('prospects');
    }
}
