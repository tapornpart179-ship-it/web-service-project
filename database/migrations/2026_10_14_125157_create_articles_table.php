<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Model;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // หัวข้อข่าว
            $table->text('content'); // เนื้อหาข่าว
            $table->string('category'); // หมวดหมู่
            $table->string('image_url')->nullable(); // ลิงก์รูปปก
            $table->string('author')->nullable(); // ผู้เขียน
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
        Schema::dropIfExists('articles');
    }
};
