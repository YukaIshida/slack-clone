<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Resources\UserCollection;

class UserController extends Controller
{
    public function index(Request $request)
    {
        // ToDo ポリシー追加?(Passportと併用出来るかテストする)
        if ($request->has('searchKey') && !empty($request->input('searchKey'))) {
            $users = User::where('name', 'like', "%" . $request->input('searchKey') . "%")->get();
        } else {
            $users = User::all();
        }
        return new UserCollection($users);
    }

}
