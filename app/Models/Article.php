<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;
    // ป้องกันความปลอดภัย
    // กำหนดฟิลด์ที่อนุญาตให้เพิ่มหรือแก้ไขข้อมูลข่าวผ่าน Article::create() และ update()
    protected $fillable = [
        'title', // หัวข้อข่าว
        'content', // เนื้อหาข่าว
        'category', // หมวดหมู่ข่าว
        'author', // ชื่อผู้เขียน
        'image_url', // ลิงก์รูปภาพประกอบข่าว
    ];
}