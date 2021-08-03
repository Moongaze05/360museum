<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScenesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(table: 'scenes', callback: static function (Blueprint $table) {
            $table->id();
            $table->string(column: 'museum_id');
            $table->string(column: 'title');
            $table->string(column: 'panorama');
            $table->double(column: 'default_angle')->default(0);
            $table->double(column: 'map_x')->nullable();
            $table->double(column: 'map_y')->nullable();
            $table->string(column: 'group_id')->nullable();
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
        Schema::dropIfExists(table: 'scenes');
    }
}
