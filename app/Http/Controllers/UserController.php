<?php

namespace App\Http\Controllers;

use to;
use App\Models\Post;
use App\Models\User;
use App\Mail\PostLiked;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function loginForm()
    {
        return view('user.login');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function registerForm()
    {
        return view('user.register');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $formInputs = $request->validate([
            'full_name' => 'required|max:255',
            'email' => 'required|email|unique:users,email|max:255',
            'password' => 'required|confirmed|min:5'
        ]);

        // Hash the password
        $hashedPassword = Hash::make($formInputs['password']);

        // Create user in database
        $user = User::create($formInputs);

        // Login user
        auth()->login($user);

        // Redirect user to login page
        return redirect('/login')->with('message', 'Registered successfully, proceed to login');
    }

    /**
     * Display the specified resource.
     */
    public function index()
    {
        $posts = Post::latest()->paginate(2);
        // $posts = auth()->user()->posts()->latest()->get();
        // $posts = Post::where('user_id', auth()->user()->id)->get();

        return view('home', ['posts' => $posts]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function login(Request $request)
    {
        $formInputs = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Attempt to log user in
        if(auth()->attempt($formInputs)) {
            // Regenerate user session
            $request->session()->regenerate();

            return redirect('/');
        }

        // Redirect back if login failed
        return redirect()->back()->withErrors(['email' => 'Invalid credentials'])->onlyInput('email');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function logout(Request $request)
    {
        auth()->logout();

        // Invalidate user session and regenerate token
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
