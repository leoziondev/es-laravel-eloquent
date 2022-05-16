<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/pagination', function () {
    $filter = request('name');
    $totalPage = request('paginate', 10);

    // $users = User::paginate(15);
    // $users = User::where('name', 'LIKE', '%in%')->paginate(15);
    // $users = User::where('name', 'LIKE', '%'.$filter.'%')->paginate(10);
    $users = User::where('name', 'LIKE', '%'.$filter.'%')->paginate($totalPage);

    return $users;
});

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
