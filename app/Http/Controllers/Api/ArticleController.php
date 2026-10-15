<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::all();

        return response()->json([
            'status' => 'success',
            'data' => $articles,
        ], 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'category' => 'required|string',
        ]);

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

    public function update(Request $request, $id)
    {
        $article = Article::find($id);

        if (!$article) {
            return response()->json([
                'status' => 'error',
                'message' => 'ไม่พบข้อมูลข่าวที่ต้องการแก้ไข',
            ], 404);
        }

        $article->update($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'อัปเดตข้อมูลข่าวสำเร็จ',
            'data' => $article,
        ], 200);
    }

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
