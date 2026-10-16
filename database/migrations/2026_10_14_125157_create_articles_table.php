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
            $table->id(); // รหัสข่าว ใช้ระบุข่าวแต่ละรายการ
            $table->string('title'); // หัวข้อข่าว
            $table->text('content'); // เนื้อหาข่าว
            $table->string('category'); // หมวดหมู่
            $table->string('image_url')->nullable(); // ลิงก์รูปป/fthyt
            $table->string('author')->nullable(); // ผู้เขียน
            $table->timestamps(); // วันที่สร้างข้อมูล (created_at) และวันที่แก้ไขล่าสุด (updated_at)
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    // ลบตาราง articles ออกเมื่อย้อนกลับการ migrate
    public function down()
    {
        Schema::dropIfExists('articles');
    }
};
