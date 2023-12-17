<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('parent_id')->nullable()->references('id')->on('permissions')->onDelete('cascade')->onUpdate('cascade');
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('menu_icon')->nullable();
            $table->string('menu_link')->nullable();
            $table->boolean('is_menu')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permissions');
    }
};
