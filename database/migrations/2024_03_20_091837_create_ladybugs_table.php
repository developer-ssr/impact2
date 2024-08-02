<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ladybugs', function (Blueprint $table) {
            $table->increments('id');
            $table->char('uuid')->nullable();;
            $table->char('user_id')->nullable();;
            $table->string('name')->nullable();;
            $table->string('file')->nullable();;
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ladybugs');
    }
};
