<?php

use App\Models\State;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->onDelete('cascade');
            $table->string('photo')->default(url(asset('img/user-avatar.svg')));
            $table->string('deployed_state', 4)->nullable();
            $table->string('nysc_call_up_number')->nullable();
            $table->string('nysc_state_code')->nullable();
            $table->string('phone_number')->nullable();
            $table->foreignIdFor(State::class, 'state_code');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profiles');
    }
}
