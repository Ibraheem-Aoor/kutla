<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public $actions;
    public $last_news_main;
    public $most_tags_use;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $date_now=date('Y-m-d H:i:s');
            $actions=\App\Models\ActionRole::where('user_id', auth()->user()->id)->pluck('name')->toArray();
            if(empty($actions)){
                $actions=\App\Models\ActionRole::where('role_id', auth()->user()->role_id)->wherenull('user_id')->pluck('name')->toArray();

            }

            $this->actions =$actions;

            view()->share('actions', $this->actions);
            view()->share('last_news_main', $this->last_news_main);
            view()->share('most_tags_use', $this->most_tags_use);

            return $next($request);
        });


    }
}
