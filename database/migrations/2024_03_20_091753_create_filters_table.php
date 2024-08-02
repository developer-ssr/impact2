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
        Schema::create('filters', function (Blueprint $table) {
            $table->increments('id');
            $table->char('uuid')->nullable();
            $table->char('item_id')->nullable();
            $table->string('name')->nullable();
            $table->char('user_id')->nullable();
            $table->MediumText ('data')->nullable();
            $table->text('src')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('filters');
    }
};
