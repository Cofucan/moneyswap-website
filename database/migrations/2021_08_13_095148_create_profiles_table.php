<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->integer('activation_code')->nullable()->unique();
            $table->foreignId('organization_id')->nullable()->constrained();
            $table->integer('bvn')->nullable();
            $table->foreignId('country_id')->constrained();
            $table->string('first_name');
            $table->string('last_name');
            $table->enum('gender', ['Male', 'Female'])->nullable();
            $table->date('birthday')->nullable();
            $table->char('status', 20);
            $table->datetime('activated_at')->nullable();
            $table->boolean('published');
            $table->softDeletes($column = 'deleted_at', $precision = 0);
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
        Schema::dropIfExists('profiles');
    }
}
