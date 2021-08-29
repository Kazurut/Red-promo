<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function GuzzleHttp\Promise\all;

class NewsController extends Controller
{
    /*
     * Главная страница, избранные новости
     * */
    public function home() {
        /*
         * Получаем все новости, где chosen = 1, т.е. избранные новости
         * */
        $table = DB::table('news')
            ->where('chosen', 1)
            ->get();
        return view('home', ['data' => $table->all()]);
    }

    /*
     * Поиск по новостям
     * */
    public function search(Request $request) {
        /*
         * Получаем все новости, где встречается указанная строка
         * */
        $table = DB::table('news')
            ->where('title', 'like', '%'.$request->input('search').'%')
            ->orWhere('description', 'like', '%'.$request->input('search').'%')
            ->orWhere('text', 'like', '%'.$request->input('search').'%')
            ->get();
        return view('search', ['data' => $table->all()]);
    }

    /*
     * Все новости
     * */
    public function news() {
        /*
         * Получаем все новости (все элементы из таблицы)
         * */
        $table = DB::table('news')
            ->get();
        return view('news', ['data' => $table->all()]);
    }

    /*
     * Детальная страница
     * */
    public function newsDetail($id) {
        /*
         * Выбираем одну новость по id
         * */
        $table = DB::table('news')
            ->where('id', $id)
            ->get();
        /*
         * Выбираем похожие новости (новости из одной категории, но без текущей)
         * */
        $similarNews = DB::table('news')
            ->where('id', '<>', $id)
            ->where('category', $table->all()[0]->category)
            ->get();
        return view('newsDetail', ['data' => $table->all(), 'similarNews' => $similarNews->all()]);
    }

    /*
     * Отмечаем новость избранной
     * */
    public function addToChosen(Request $request){
        /*
         * Узнаем текущий статус (избранная новость или нет)
         * */
        $chosen = DB::table('news')
            ->select('chosen')
            ->where('id', $request->input('id'))
            ->get();
        /*
         * Если избранная, то меняем на не избранную и наоборот
         * */
        if($chosen->all()[0]->chosen == '1'){
            DB::table('news')
                ->where('id', $request->input('id'))
                ->update(['chosen' => 0]);
        }else{
            DB::table('news')
                ->where('id', $request->input('id'))
                ->update(['chosen' => 1]);
        }
        return $chosen;
    }
}
