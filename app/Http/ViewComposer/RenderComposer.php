<?php

namespace App\Http\ViewComposer;

use Illuminate\View\View;
use App\Repositories\UserRepository;
use App\Helper\Lib;
class RenderComposer
{
    public function compose(View $view)
    {
        $view->with('auth', Lib::auth());
    }
}