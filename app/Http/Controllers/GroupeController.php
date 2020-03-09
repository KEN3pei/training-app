<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use Auth;
use App\Groupe;
use App\Groupemembar;
use Storage;

class GroupeController extends Controller
{
    public function index()
    {
        
        // Listページを最初に表示する機能
        // 自分以外の全ユーザーを表示
        $user = Auth::user()->id;
        $list_names = Groupe::where('user_id', $user)->get();
        if ($list_names === []) {
            $list_names = null;
        }
        
        $user_all = User::all();
        // dd($user_all);
        $groupes = Groupe::all();
        //defaultでログイン中ユーザのgroupeの名前一覧を表示
        //groupeがないときの処理も行う
        //全部のgroupeの名前を取得後配列にしてviewに渡す
        //groupeの名前を取得
        // groupeがないときも考える
        // $user_all==自分以外のuser情報を取得
        //$list_names==自分のlistの名前一覧
        // ['user_all' => $user_all, 'lists' => $lists]
        return view('training.groupe', ['user_all' => $user_all, 'groupes' => $groupes, 'list_names' => $list_names]);
    }
    
    public function create(Request $request)
    {
        
        //listの新規作成
        $this->validate($request, Groupe::$rules);
        // dd($request);
        //groupeテーブルをnewして値をsaveで保存
        $list_name = $request->list_name;
        $user_id = Auth::user()->id;
        $groupe = new Groupe;
        // dd($groupe);
        $groupe->user_id = $user_id;
        $groupe->list_name = $list_name;
        $groupe->save();
        
        // dd($groupe);
        return redirect('/groupe');
    }
    
    public function search(Request $request)
    {
        //検索機能
        // formから$requestされた値と一致する文字をもつユーザーを表示する
        // dd($request->list_membar);
        $list_membar = $request->list_membar;
        if ($list_membar === null) {
            return redirect('/groupe');
        }
        $str_membar = User::where('name', 'LIKE', "%{$list_membar}%")->get();
        $user_all = [];
        foreach ($str_membar as $membar) {
            $user_all[] = $membar;
        }
        $groupes = Groupe::all();
        
        $user = Auth::user()->id;
        $list_names = Groupe::where('user_id', $user)->get();
        if ($list_names === []) {
            $list_names = null;
        }
        
        // dd($groupe);
        // dd($create_lists);
        //Userテーブルにformからの値を名前で検索する
        //その中からnameとimageを取得
        return view('training.groupe', ['user_all' => $user_all, 'groupes' => $groupes, 'list_names' => $list_names]);
        // return redirect('/groupe?='. $list_membar)->with([
        //         'user_all' => $user_all,
        //         'lists' => $lists
        //         ]);
    }
    
    public function add_groupe(Request $request)
    {
        
        //membarの追加機能
        //dropdownをクリック->自分のlistに追加
        //listがない場合を想定
        //listの選定
        //userの判別
        $this->validate($request, Groupemembar::$rules);
        // dd($request->list_id);
        $list_id = $request->list_id;
        $add_list = Groupe::find($list_id);//該当するリストのレコードを取得
        $user_id = $add_list->user_id;
        $user = User::find($user_id);//該当するuserを取得

        $group_all = new Groupemembar;
        $group_all->list_id = $list_id;
        $group_all->list_membar = $user->name;
        $group_all->timestamps = false;
        $group_all->save();
        
        // return redirect('/groupe/serch');
        return redirect()->back();
    }
}
