<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Pagination\Paginator;

class HomeController extends Controller
{
    //
    public function index()
    {
        $users = User::orderBy('name')->get();
        $today = Carbon::now()->toDateString();
        $posts = Post::whereDate('created_at', $today)->where('status', 1)->paginate(15);
        Paginator::useBootstrap();
        return view('home', compact('users', 'posts'));
    }

    public function filter(Request $request)
    {
        $request->validate([
            'user' => 'nullable|exists:users,id',
            'startDate' => 'nullable|date',
            'endDate' => 'nullable|date|after_or_equal:startDate',
        ]);

        $users = User::orderBy('name')->get();

        $query = Post::query()->where('status', 1);

        if ($request->filled('user') && $request->user != 'Please select') {
            $query->where('user_id', $request->user);
        }

        $startDate = Carbon::parse($request->startDate)->startOfDay();
        $endDate = Carbon::parse($request->endDate)->endOfDay();

        if ($request->filled('startDate') && $request->filled('endDate')) {
            $query->whereDate('created_at', '>=', $startDate)
                ->whereDate('created_at', '<=', $endDate);
        }

        $posts = $query->paginate(15);

        $posts->load('user');

        return view('home', compact('posts', 'users'));
    }
}
