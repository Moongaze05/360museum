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
            $table->string('scene_id');
            $table->string('title');
            $table->enum('type', ['info', 'scene'])->default('info');
            $table->double('pitch');
            $table->double('yaw');
            $table->unsignedBigInteger('map_x');
            $table->unsignedBigInteger('map_y');
            $table->string('pointer_target')->nullable();
            $table->string('document_id')->nullable();
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
