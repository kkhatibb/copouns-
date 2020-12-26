<?php

namespace App\Http\Controllers\Front;

use App\Contact;
use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest;
use App\Page;
use App\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class HomeController extends Controller
{

    public function index()
    {
        $data['about'] = Page::find(1);
        $data['download'] = Page::find(2);
        $data['shops'] = Shop::all();
        return view('front.index', $data);
    }

    public function changeLang(Request $request)
    {
        $request['lang'] = $request->lang;
        $lang = $request->lang;
        $url = LaravelLocalization::getLocalizedURL($lang, url()->previous());
        return Redirect::to($url);
    }

    public function privacyPolicy()
    {
        $data['page'] = Page::find(3);
        return view('front.page' , $data);
    }


    public function showContacts()
    {
        return view('front.contacts');
    }
    public function contacts(ContactRequest $request)
    {
        Contact::create($request->all());
        return back()->with('success' , __('front.msgSent'));
    }
}
