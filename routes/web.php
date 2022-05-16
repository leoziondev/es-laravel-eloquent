<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/where', function(User $user) {
    $filter = 'un';

    // $users = $user->get();
    // $users = $user->where('email', 'hsmitham@example.com')->first();
    // $users = $user->where('email', 'LIKE', "%" . $filter . "%")->get();
    // $users = $user->where('name', 'LIKE', "%" . $filter . "%")
    //     ->orWhere('name', 'Carlos')
    //     ->get();
    // $users = $user->where('name', 'LIKE', "%" . $filter . "%")
    //     ->whereNot('name', 'Carlos')
    //     // ->whereDate()
    //     // ->whereIn('email', [])
    //     // ->orWhereIn('email', [])
    //     ->get();
    $users = $user->where('name', 'LIKE', "%" . $filter . "%")
        ->orWhere(function ($query) use ($filter) {
            $query->where('name', '<>', 'Carlos');
            $query->where('name', '=', $filter);
        })
        ->toSql();

    dd($users);
});

Route::get('/select', function() {
    // $users = User::all();
    // $users = User::get();
    // $users = User::where('id', 1)->get();
    // $users = User::where('id', '>=', 10)->get();
    // $user = User::where('id', 10)->first();
    // $user = User::first();
    // $user = User::find(10);
    // $user = User::findOrFail(10);
    // $user = User::findOrFail(request('id'));
    // $user = User::where('name', request('name'))->firstOrFail();
    $user = User::firstWhere('name', request('name'));

    // dd($users);
    dd($user);
});

Route::get('/', function () {
    return view('welcome');
});
