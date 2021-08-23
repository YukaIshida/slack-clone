<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ChannelUser;

class TestController extends Controller
{
    public function __invoke(Request $request)
    {
        $user = ChannelUser::joining_users(1);

        dd($user);
    }
}
