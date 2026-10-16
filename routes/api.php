<?php

use App\Http\Controllers\Api\ArticleController;
use App\Http\Controllers\Api\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
| //lalavel sanctum หน้าที่ปกป้องการยืนยันตัวตนจะต้องส่ง token ที่ได้จากการล็อกอินมาด้วย
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// ดูข้อมูลผู้ใช้ที่กำลังเข้าสู่ระบบ ต้องส่ง Sanctum token
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// เข้าสู่ระบบด้วยอีเมลและรหัสผ่าน เพื่อรับ token สำหรับเรียก API ที่ต้องยืนยันตัวตน
Route::post('/login', [AuthController::class, 'login']);

// แสดงรายการข่าวทั้งหมดและแสดงข่าวตาม ID โดยไม่ต้องเข้าสู่ระบบ
Route::apiResource('articles', ArticleController::class)->only([
    'index',
    'show',
]);

// เส้นทางภายในกลุ่มนี้ต้องยืนยันตัวตนด้วย Sanctum token
Route::middleware('auth:sanctum')->group(function () {
    // ออกจากระบบและเพิกถอน token ที่ใช้อยู่
    Route::post('/logout', [AuthController::class, 'logout']);

    // เพิ่ม แก้ไข และลบข่าว
    Route::apiResource('articles', ArticleController::class)->only([
        'store',
        'update',
        'destroy',
    ]);
});
