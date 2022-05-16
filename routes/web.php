<?php

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

Route::get('/accessor', function () {
    $posts = Post::get();
    return $posts;

    // $post = Post::find(1);
    // return $post->title_and_body;
});

Route::get('/delete2', function() {
    Post::destroy(4);

    $posts = Post::get();

    return $posts;
});

Route::get('/delete', function() {
    $post = Post::where('id', 4)->first();
    // Post::destroy(ID);

    if (!$post)
        return 'Post not found';

    dd($post->delete());
});

Route::get('/update', function () {
    if (!$post = Post::find(1))
        return "Post not found";

    // $post->title = "Title Updated";
    // $post->save();

    $post->update([
        'title' => "Title Updated Again",
    ]);
    // or
    // $post->update($request->all());


    dd($post);
});

// Route::get('/insert2', function (Request $request) {
Route::get('/insert2', function () {
    // $post = Post::create($request->all());
    $post = Post::create([
        'user_id'   => 2,
        'title'     => "Lorem ipsum dollor 03",
        'body'      => "Sit amet ipsum lorem dollor",
        'date'      => date('Y-m-d'),
    ]);

    // dd($post);

    $posts = Post::latest()->get();

    return $posts;
});

Route::get('/insert', function (Post $post, Request $request) {
    $post->user_id = 1;
    // $post->title = "Post 01 " . Str::random(10);
    $post->title = $request->name;
    $post->body = "Content 01";
    $post->date = date('Y-m-d');

    $post->save();

    $posts = Post::get();
    return $posts;
});

Route::get('/orderby', function () {
    // $users = User::orderBy('id', 'desc')->get(); // default ASC
    $users = User::orderBy('name')->get();

    return $users;
});

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
