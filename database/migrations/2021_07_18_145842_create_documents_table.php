<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(table: 'documents', callback: static function (Blueprint $table) {
            $table->id();
            $table->string(column: 'image');
            $table->string(column: 'title');
            $table->string(column: 'author');
            $table->longText(column: 'description')->nullable();
            $table->string(column: 'audio')->nullable();
            $table->double('parent_x')->nullable();
            $table->double('parent_y')->nullable();
            $table->double('parent_id')->nullable();
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
        Schema::dropIfExists(table: 'documents');
    }
}
