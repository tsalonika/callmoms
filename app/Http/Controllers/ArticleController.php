<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = DB::table('articles')->orderBy('created_at', 'desc')->get();
        return view('Articles.index', compact('articles'));
    }

    public function getById($id)
    {
        $article_detail = DB::table('articles')->where('id_articles', $id)->first();
        $creator = DB::table('psychologists')->where('id_psychologists', $article_detail->creator_id)->first();
        $creatorName = DB::table('users')->where('id_users', $creator->users_id)->first();

        return view('Articles.detail', compact('article_detail', 'creatorName'));
    }

    public function showListArticles()
    {
        $articles = DB::table('articles')->orderBy('created_at', 'desc')->get();
        return view('Psychologist.operate', compact('articles'));
    }

    public function createArticle(Request $request)
    {
        $imagePath = null;
        try {
            $request->validate([
                'title' => 'required|string',
                'image' => 'required|image',
                'content' => 'required|string',
            ]);

            // Handle the image file
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $filename = Str::random(40) . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('storage/articles'), $filename);
                $imagePath = 'articles/' . $filename;
            }

            // Create a new article instance
            $article = new Article();
            $article->title = $request->title;
            $article->image = $imagePath;
            $article->content = $request->input('content');
            $article->creator_id = $request->creator_id;
            $article->save();

            return redirect()->back()->with('success', 'Artikel Baru Berhasil Diupload');
        } catch (\Exception $e) {
            if ($imagePath) {
                unlink(public_path('storage/' . $imagePath));
            }
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function editArticle(Request $request)
    {
        $imagePath = null;
        try {
            $request->validate([
                'title' => 'required|string',
                'image' => $request->hasFile('image') ? 'required|image' : '',
                'content' => 'required|string'
            ]);

            $article = Article::findOrFail($request->id);

            if ($request->hasFile('image')) {

                if($article->image) {
                    $oldImagePath = public_path('storage/' . $article->image);
                    if(file_exists($oldImagePath)) {
                        unlink($oldImagePath);
                    }
                }

                $file = $request->file('image');
                $filename = Str::random(40) . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('storage/articles'), $filename);
                $imagePath = 'articles/' . $filename;
                $article->image = $imagePath;
            }

            $article->title = $request->title;
            $article->content = $request->input('content');
            $article->creator_id = $request->creator_id;
            $article->save();
    
            return redirect()->back()->with('success', 'Artikel Berhasil Diperbarui');
        }  catch (\Exception $e) {
            if ($imagePath) {
                unlink(public_path('storage/' . $imagePath));
            }
            return $e->getMessage();
        }
    }

    public function deleteArticle($id)
    {
        try {
            $article = Article::findOrFail($id);
            Storage::disk('public')->delete($article->image);
            $article->delete();
            return response()->json(['message' => 'Berhasil Menghapus Artikel'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Gagal Menghapus Artikel', 'error' => $e->getMessage()], 500);
        }
    }
}
