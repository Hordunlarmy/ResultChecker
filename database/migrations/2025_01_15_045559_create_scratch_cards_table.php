<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up()
    {
        Schema::create('scratch_cards', function (Blueprint $table) {
            $table->id();
            $table->string('pin')->unique();
            $table->boolean('is_used')->default(false);
            $table->timestamps();
        });

        Schema::create('used_scratch_cards', function (Blueprint $table) {
            $table->id();
            $table->string('pin')->unique();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamp('used_at');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('used_scratch_cards');
        Schema::dropIfExists('scratch_cards');
    }
};
