<?php

use Illuminate\Support\Facades\Input;
use \Illuminate\Support\Str;

function getDatatable($items, $relations = [])
{
    $pagination = Input::get('pagination');
    $query = Input::get('query');

    $search = @$query['generalSearch'];

    $sort = Input::get('sort');


    if ($pagination['perpage'] == -1 || $pagination['perpage'] == null) {
        $pagination['perpage'] = 10;
    }

    $items = $items->with($relations);

    if ($search != null) {
        $items->filter($search);
    }

    if ($sort && count($sort)) {
        $items->orderBy($sort['field'], $sort['sort']);
    } else {
        $items->orderByDesc('created_at');
    }

    $itemsCount = $items->count();
    $items = $items->take($pagination['perpage'])->skip($pagination['perpage'] * ($pagination['page'] - 1))->get();
    $pagination['total'] = $itemsCount;
    $pagination['pages'] = ceil($itemsCount / $pagination['perpage']);

    $data['meta'] = $pagination;
    $data['data'] = $items;
    return $data;
}


function strLimit($str , $limit){
    return Str::limit($str , $limit , '...');
}

function locales()
{
    $arr = [];
    foreach (LaravelLocalization::getSupportedLocales() as $key => $value) {
        $arr[$key] = __('common.' . $value['name']);
    }
    return $arr;
}

function getShops(){
    return \App\Shop::all();
}
function getCatagories(){
    return \App\Catagory::all();
}

function getSetting($key)
{
    return \App\Setting::getSetting($key)->value;
}


?>
