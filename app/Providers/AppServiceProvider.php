<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Memo;
use App\Models\Tag;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        view()->composer('*', function ($view) {

            $memo_model = new Memo();
            $memos = $memo_model->getMyMemo();

            $tags = Tag::where('user_id', '=', \Auth::id())
                ->whereNull('deleted_at')
                ->orderBy('id', 'DESC')
                ->get();

            $view->with('memos', $memos)->with('tags', $tags);
        });
    }
}
