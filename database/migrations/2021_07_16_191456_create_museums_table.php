<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMuseumsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(table: 'museums', callback: static function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string(column: 'title');
            $table->string(column: 'preview');
            $table->string(column: 'logo');
            $table->string(column: 'map');
            $table->string(column: 'default_scene')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists(table: 'museums');
    }
}
