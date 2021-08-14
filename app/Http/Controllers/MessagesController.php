<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Message;  

class MessagesController extends Controller
{
    // getでmessages/にアクセスされた場合の「一覧表示処理」
    public function index()
    {
        // メッセージ一覧を取得
        $messages = Message::all();

        // メッセージ一覧ビューでそれを表示
        return view('messages.index', [
            'messages' => $messages,
        ]);
    }

    // getでmessages/createにアクセスされた場合の「新規登録画面表示処理」
    public function create()
    {
        $message = new Message;

        // メッセージ作成ビューを表示
        return view('messages.create', [
            'message' => $message,
        ]);
    }
    // postでmessages/にアクセスされた場合の「新規登録処理」
    public function store(Request $request)
    {
        $request->validate([
            'content' =>'required|max:255',
            ]);
        
        // メッセージを作成
        $message = new Message;
        $message->content = $request->content;
        $message->save();

        // トップページへリダイレクトさせる
        return redirect('/');
    }

    // getでmessages/（任意のid）にアクセスされた場合の「取得表示処理」
    public function show($id)
    {
        // idの値でメッセージを検索して取得
        $message = Message::findOrFail($id);

        // メッセージ詳細ビューでそれを表示
        return view('messages.show', [
            'message' => $message,
        ]);
    }
    // getでmessages/（任意のid）/editにアクセスされた場合の「更新画面表示処理」
    public function edit($id)
    {
        // idの値でメッセージを検索して取得
        $message = Message::findOrFail($id);

        // メッセージ編集ビューでそれを表示
        return view('messages.edit', [
            'message' => $message,
        ]);
    }


    // putまたはpatchでmessages/（任意のid）にアクセスされた場合の「更新処理」
    // putまたはpatchでmessages/idにアクセスされた場合の「更新処理」
    public function update(Request $request, $id)
    {
        $request->validate([
            'content' => 'required|max:255',
        ]);

        
        // idの値でメッセージを検索して取得
        $message = Message::findOrFail($id);
        // メッセージを更新
        $message->content = $request->content;
        $message->save();

        // トップページへリダイレクトさせる
        return redirect('/');
    }


    // deleteでmessages/（任意のid）にアクセスされた場合の「削除処理」
    public function destroy($id)
    {
        // idの値でメッセージを検索して取得
        $message = Message::findOrFail($id);
        // メッセージを削除
        $message->delete();

        // トップページへリダイレクトさせる
        return redirect('/');
    }
    

}