<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Validator;

class ArticlesController extends Controller
{
    public function showArticles()
    {
        $articles = Post::all();
        return response()->json($articles);
    }

    public function showArticle($id)
    {
        $article = Post::find($id);
        if (!$article) {
            return response()
                ->json([
                    "status" => false,
                    "message" => "Пост не найден",
                ])
                ->setStatusCode(404, 'Пост не найден');
        }
        return response()->json($article);
    }

    public function storeArticle(Request $request)
    {
        $request_data = $request->only(['title', 'description', 'content', 'category_id']);

        $validator = Validator::make($request_data, [
            "title" => ['required', 'string'],
            "description" => ['required', 'string'],
            "content" => ['required', 'string'],
            "category_id" => ['required', 'integer'],
        ]);
        if ($validator->fails()) {
            return response()
                ->json([
                    "status" => false,
                    "errors" => $validator->messages(),
                ])
                ->setStatusCode(422);
        }

        $article = Post::create([
            "title" => $request->title,
            "description" => $request->description,
            "content" => $request->content,
            "category_id" => $request->category_id,
        ]);
        return response()
            ->json([
                "status" => true,
                "article" => $article,
            ])
            ->setStatusCode(201, 'Статья добавлена');
    }

    public function putArticle($id, Request $request)
    {
        //  dd($request);
        $request_data = $request->only(['title', 'description', 'content', 'category_id']);

        if (count($request_data) === 0) {
            return response()
                ->json([
                    "status" => false,
                    "errors" => "Все поля пустые",
                ])
                ->setStatusCode(422, "Все поля пустые");
        }

        $validator = Validator::make($request_data, [
            "title" => ['required', 'string'],
            "description" => ['required', 'string'],
            "content" => ['required', 'string'],
            "category_id" => ['required', 'integer'],
        ]);
        if ($validator->fails()) {
            return response()
                ->json([
                    "status" => false,
                    "errors" => $validator->messages(),
                ])
                ->setStatusCode(422);
        }
        $article = Post::find($id);
        if (!$article) {
            return response()
                ->json([
                    "status" => false,
                    "message" => "Статья не найдена",
                ])
                ->setStatusCode(404, "Статья не найдена");
        }
        $article->title = $request_data["title"];
        $article->description = $request_data["description"];
        $article->content = $request_data["content"];
        $article->category_id = $request_data["category_id"];
        $article->save();
        return response()
            ->json([
                "status" => true,
                "message" => "Статья обновлена",
            ])
            ->setStatusCode(200, 'Статья обновлена');
    }

    public function patchArticle($id, Request $request)
    {
        $request_data = $request->only(['title', 'description', 'content', 'category_id']);

        if (count($request_data) === 0) {
            return response()
                ->json([
                    "status" => false,
                    "errors" => "Все поля пустые",
                ])
                ->setStatusCode(422, "Все поля пустые");
        }

        $rules_const = [
            "title" => ['required', 'string'],
            "description" => ['required', 'string'],
            "content" => ['required', 'string'],
            "category_id" => ['required', 'integer'],
        ];
        $rules = [];
        foreach ($request_data as $key => $data) {
            $rules[$key] = $rules_const[$key];
        }

        $validator = Validator::make($request_data, $rules);
        if ($validator->fails()) {
            return response()
                ->json([
                    "status" => false,
                    "errors" => $validator->messages(),
                ])
                ->setStatusCode(422);
        }
        $article = Post::find($id);
        if (!$article) {
            return response()
                ->json([
                    "status" => false,
                    "message" => "Статья не найдена",
                ])
                ->setStatusCode(404, "Статья не найдена");
        }

        foreach ($request_data as $key => $data) {
            $article->$key = $data;
        }
        $article->save();
        return response()
            ->json([
                "status" => true,
                "message" => "Статья обновлена",
            ])
            ->setStatusCode(200, 'Статья обновлена');
    }

    public function deleteArticle($id)
    {
        $article = Post::find($id);
        if (!$article) {
            return response()
                ->json([
                    "status" => false,
                    "message" => "Статья не найдена",
                ])
                ->setStatusCode(404, "Статья не найдена");
        }
        $article->delete();
        return response()
            ->json([
                "status" => true,
                "message" => "Статья удалена",
            ])
            ->setStatusCode(200, "Статья удалена");
    }
}
