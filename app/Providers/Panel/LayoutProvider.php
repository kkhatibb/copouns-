<?php

namespace App\Providers\Panel;

use App\Complaint;
use App\Contact;
use App\Suggestion;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class LayoutProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('panel.layout.master', function ($view) {
            $data['newComplaint'] = Complaint::query()->where('read_at',null)->count();
            $data['newSuggestions'] = Suggestion::query()->where('read_at',null)->count();
            $data['newContacts'] = Contact::query()->where('read_at',null)->count();
            $view->with($data);
        });
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
