<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('wallets')) {
            return;
        }

        Schema::create('wallets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('profile_id');
            $table->unsignedBigInteger('bank_id');
            $table->unsignedBigInteger('currency_id');
            $table->unsignedBigInteger('payment_gateway_id')->nullable();
            $table->string('reference_token');
            $table->string('account_name')->nullable();
            $table->integer('account_number')->nullable();
            $table->double('balance', 8, 2);
            $table->double('blocked', 8, 2);
            $table->datetime('activated_at')->nullable();
            $table->boolean('published');
            $table->string('status', 20);
            $table->boolean('main');
            $table->unsignedBigInteger('user_id');
            $table->softDeletes($column = 'deleted_at', $precision = 0);
            $table->timestamps();
        });

        // Best-effort FKs; ignore failures if referenced tables are incompatible.
        $this->tryAddFk('wallets', 'profile_id', 'profiles');
        $this->tryAddFk('wallets', 'bank_id', 'banks');
        $this->tryAddFk('wallets', 'currency_id', 'currencies');
        $this->tryAddFk('wallets', 'payment_gateway_id', 'payment_gateways');
        $this->tryAddFk('wallets', 'user_id', 'users');
    }

    public function down(): void
    {
        Schema::dropIfExists('wallets');
    }

    private function tryAddFk(string $table, string $column, string $references): void
    {
        if (!Schema::hasTable($table) || !Schema::hasTable($references)) {
            return;
        }

        try {
            Schema::table($table, function (Blueprint $table) use ($column, $references) {
                $table->foreign($column)->references('id')->on($references)->nullOnDelete();
            });
        } catch (\Throwable $e) {
            // Ignore if FK cannot be created due to incompatible schema/engine.
        }
    }
};
