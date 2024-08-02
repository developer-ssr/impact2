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
        Schema::create('items', function (Blueprint $table) {
            $table->increments('id');
            $table->char('uuid')->nullable();
            $table->char('project_id')->nullable();
            $table->char('user_id')->nullable();
            $table->char('folder_id')->nullable();
            $table->string('name')->nullable();
            $table->string('code')->nullable();
            $table->MediumText('settings')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
