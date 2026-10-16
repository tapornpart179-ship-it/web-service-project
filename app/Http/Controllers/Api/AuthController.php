<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // ตรวจสอบข้อมูลล็อกอินและออก Sanctum token เมื่อยืนยันตัวตนสำเร็จ
    public function login(Request $request)
    {
        // ตรวจสอบว่ารูปแบบอีเมลถูกต้องและมีการส่งรหัสผ่านมา
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // ค้นหาบัญชีผู้ใช้ด้วยอีเมลที่ส่งมา
        $user = User::where('email', $request->email)->first();

        // ปฏิเสธคำขอเมื่อไม่พบบัญชีหรือรหัสผ่านไม่ตรงกัน
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'status' => 'error',
                'message' => 'อีเมลหรือรหัสผ่านไม่ถูกต้อง',
            ], 401);
        }

        // สร้าง token สำหรับใช้ยืนยันตัวตนในการเรียก API
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'status' => 'success',
            'message' => 'เข้าสู่ระบบสำเร็จ',
            'user' => $user,
            'token' => $token,
        ], 200);
    }

    // เพิกถอน token ที่ใช้เรียกคำขอล็อกเอาต์ปัจจุบัน
    public function logout(Request $request)
    {
        //สั่งยกเลิกและทำลาย Token ทิ้งจากฐานข้อมูลด้วย
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'ออกจากระบบเรียบร้อยแล้ว',
        ], 200);
    }
}
