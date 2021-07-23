<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHotspotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(table: 'hotspots', callback: static function (Blueprint $table) {
            $table->id();
            $table->string(column: 'scene_id');
            $table->string(column: 'title');
            $table->enum(column: 'type', allowed: ['info', 'scene'])->default('info');
            $table->double(column: 'pitch');
            $table->double(column: 'yaw');
            $table->string(column: 'pointer_target')->nullable();
            $table->string(column: 'document_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists(table: 'hotspots');
    }
}
