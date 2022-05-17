<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ArticleResource;
use App\Models\Article;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Library\ApiHelpers;

class ArticleController extends Controller
{

    use ApiHelpers;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($this->isAdmin($request->user())) {
            $article = Article::all();
            return $this->onSuccess($article, 'Article Retrieved');
        }
        return $this->onError(401, 'Unauthorized Access');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = $request->user();
        if ($this->isAdmin($user) || $this->isWriter($user)) {
            $validator = Validator::make($request->all(), $this->articleValidationRules());
            if ($validator->passes()) {
                $article = new Article();
                $article->name = $request->input('name');
                $article->content = $request->input('content');
                $article->image = $request->input('image');
                $article->save();
                return $this->onSuccess($article, 'Article Created');
            }
            return $this->onError(400, $validator->errors());
        }
        return $this->onError(401, 'Unauthorized Access');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $user = $request->user();
        if ($this->isAdmin($user) || $this->isWriter($user) || $this->isSubscriber($user)) {
            $article = Article::where('id', $id)->first();
            if (!empty($article)) {
                return $this->onSuccess($article, 'Article Retrieved');
            }
            return $this->onError(404, 'Article Not Found');
        }
        return $this->onError(401, 'Unauthorized Access');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = $request->user();
        if ($this->isAdmin($user) || $this->isWriter($user)) {
            $validator = Validator::make($request->all(), $this->articleValidationRules());
            if ($validator->passes()) {
                $article = Article::find($id);
                $article->name = $request->input('name');
                $article->content = $request->input('content');
                $article->image = $request->input('image');
                $article->save();
                return $this->onSuccess($article, 'Article Updated');
            }
            return $this->onError(400, $validator->errors());
        }
        return $this->onError(401, 'Unauthorized Access');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $user = $request->user();
        if ($this->isAdmin($user) || $this->isWriter($user)) {
            $article = Article::find($id); // Найдем id сообщения
            $article->delete(); // Удаляем указанное сообщение
            if (!empty($article)) {
                return $this->onSuccess($article, 'Article Deleted');
            }
            return $this->onError(404, 'Article Not Found');
        }
        return $this->onError(401, 'Unauthorized Access');
    }

    public function createWriter(Request $request)
    {
        $user = $request->user();
        if ($this->isAdmin($user)) {
            $validator = Validator::make($request->all(), $this->userValidatedRules());
            if ($validator->passes()) {
                User::create([
                    'name' => $request->input('name'),
                    'email' => $request->input('email'),
                    'role' => 2,
                    'password' => Hash::make($request->input('password')),
                ]);
                $writerToken = $user->createToken('auth_token', ['writer'])->plainTextToken;
                return $this->onSuccess($writerToken, 'User Created With Writer Privilege');
            }
            // 2|xDZ4gCTME7BpNWlhwxQStcEFphE3LTLmM9rRSyR2
            return $this->onError(400, $validator->errors());
        }
        return $this->onError(401, 'Unauthorized Access');
    }
    public function createSubscriber(Request $request)
    {
        $user = $request->user();
        if ($this->isAdmin($user)) {
            $validator = Validator::make($request->all(), $this->userValidatedRules());
            if ($validator->passes()) {
                // Создаем нового Подписчика
                User::create([
                    'name' => $request->input('name'),
                    'email' => $request->input('email'),
                    'role' => 3,
                    'password' => Hash::make($request->input('password')),
                ]);
                $writerToken = $user->createToken('auth_token', ['subscriber'])->plainTextToken;
                return $this->onSuccess($writerToken, 'User Created With Subscriber Privilege');
            }
            return $this->onError(400, $validator->errors());
        }
        return $this->onError(401, 'Unauthorized Access');
    }
    public function deleteUser(Request $request, $id)
    {
        $user = $request->user();
        if ($this->isAdmin($user)) {
            $user = User::find($id); // Найдем id пользователя
            if ($user->role !== 1) {
                $user->delete(); // Удалим указанного пользователя
                if (!empty($user)) {
                    return $this->onSuccess('', 'User Deleted');
                }
                return $this->onError(404, 'User Not Found');
            }
        }
        return $this->onError(401, 'Unauthorized Access');
    }
}
