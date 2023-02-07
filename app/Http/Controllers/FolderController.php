<?php

namespace App\Http\Controllers;

use App\Models\Folder; // ★ この行を追記！
use Illuminate\Http\Request;
// ★ Authクラスをインポートする
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CreateFolder; // ★ 追加

class FolderController extends Controller
{
    public function showCreateForm()
    {
        return view('folders/create');
    }

    public function create(CreateFolder $request)
    {
        // フォルダモデルのインスタンスを作成する
        $folder = new Folder();
        // タイトルに入力値を代入する
        $folder->title = $request->title;
        // ★ ユーザーに紐づけて保存
        Auth::user()->folders()->save($folder);// インスタンスの状態をデータベースに書き込む

        return redirect()->route('tasks.index', [
            'id' => $folder->id,
        ]);
    }
}