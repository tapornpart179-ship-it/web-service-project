<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    // ตรงนี้เอาข่าวทั้งหมดมาแสดง ไม่ต้องส่ง ID
    public function index()
    {
        $articles = Article::all();

        return response()->json([
            'status' => 'success',
            'data' => $articles,
        ], 200);
    }

    // ตอนเพิ่มข่าว เช็กก่อนว่ามีหัวข้อ เนื้อหา และหมวดหมู่ครบไหม
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'category' => 'required|string',
        ]);

        // ถ้าไม่ได้ส่งชื่อคนเขียนมา ก็ใส่ Admin ให้เป็นค่าเริ่มต้น
        $article = Article::create([
            'title' => $request->title,
            'content' => $request->content,
            'category' => $request->category,
            'image_url' => $request->image_url,
            'author' => $request->author ?? 'Admin',
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'บันทึกข้อมูลข่าวสำเร็จ',
            'data' => $article,
        ], 201);
    }

    // รับ ID มาแล้วหาข่าว ถ้าหาไม่เจอก็แจ้งกลับว่าไม่มีข้อมูล
    public function show($id)
    {
        $article = Article::find($id);

        if (!$article) {
            return response()->json([
                'status' => 'error',
                'message' => 'ไม่พบข้อมูลข่าวที่ต้องการ',
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $article,
        ], 200);
    }

    // หาข่าวจาก ID ก่อน แล้วค่อยแก้ตามข้อมูลที่ส่งมา
    public function update(Request $request, $id)
    {
        $article = Article::find($id);

        if (!$article) {
            return response()->json([
                'status' => 'error',
                'message' => 'ไม่พบข้อมูลข่าวที่ต้องการแก้ไข',
            ], 404);
        }

        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'content' => 'sometimes|required|string',
            'category' => 'sometimes|required|string',
            'image_url' => 'sometimes|nullable|string|max:2048',
            'author' => 'sometimes|nullable|string|max:255',
        ]);

        if ($validated === []) {
            return response()->json([
                'status' => 'error',
                'message' => 'กรุณาส่งข้อมูลที่ต้องการแก้ไข',
            ], 422);
        }

        $article->update($validated);

        return response()->json([
            'status' => 'success',
            'message' => 'อัปเดตข้อมูลข่าวสำเร็จ',
            'data' => $article,
        ], 200);
    }

    // หาข่าวจาก ID แล้วลบออก ถ้าไม่มีข่าว ID นี้ก็แจ้งว่าไม่เจอ
    public function destroy($id)
    {
        $article = Article::find($id);

        if (!$article) {
            return response()->json([
                'status' => 'error',
                'message' => 'ไม่พบข้อมูลข่าวที่ต้องการลบ',
            ], 404);
        }

        $article->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'ลบข้อมูลข่าวเรียบร้อยแล้ว',
        ], 200);
    }
}
