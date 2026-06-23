<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('profile_id')->constrained();
            $table->foreignId('document_type_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->char('reference_code', 20);
            //$table->string('id_path');
            $table->string('confirmed_name', 100)->nullable();
            $table->date('issued_at')->nullable();
            $table->date('expire_at')->nullable();
            $table->datetime('verified_at')->nullable();
            $table->foreignId('verifiedby_user_id')->nullable()->constrained('users');
            $table->char('status', 20);
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
        Schema::dropIfExists('documents');
    }
}
