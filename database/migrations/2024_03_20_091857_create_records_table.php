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
        Schema::create('records', function (Blueprint $table) {
            $table->increments('id');
            $table->char('uuid')->nullable();
            $table->char('project_id')->nullable();
            $table->char('unique_id')->nullable();
            $table->text('url')->nullable();
            $table->string('device')->nullable();
            $table->char('ip')->nullable();
            $table->timestamp('started_at');
            $table->timestamp('ended_at');
            $table->char('status')->nullable();
            $table->string('data')->nullable();
            $table->MediumText('meta')->nullable();
            $table->MediumText('source')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('records');
    }
};
