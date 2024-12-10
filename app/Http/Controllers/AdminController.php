<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\Tutorial;

class AdminController extends Controller
{
    public function index()
{
    if (Auth::check()) { // Check if user is authenticated
        $post = Post::all();
        $usertype = Auth::user()->usertype;

        if ($usertype == 'user') {
            return view('home.homepage', compact('post'));
        } elseif ($usertype == 'admin') {
            return view('admin.index');
        } else {
            return redirect()->back();
        }
    } else {
        // Redirect or show a default view for guests
        return redirect('/login'); // Or return view('public.index');
    }
}

    
    public function homepage()
    {
        return view('home.homepage'); // Show the homepage
    }
    public function post_page()
    {
        return view('admin.post_page');
        }
        public function add_post(Request $request)
        {
            $user=Auth::user();
            $user_id=$user->id;
            $name=$user->name;
            $usertype=$user->usertype;

            $post=new Post;
            $post->title=$request->title;
            $post->description=$request->description;
            $post->post_status= 'active';
            $post->name=$name;
            $post->user_id=$user_id;
            $post->usertype=$usertype;
            //////////////////////
            $image=$request->image;
            if ($image) {
            $imagename=time().'.'.$image->getClientOriginalExtension();
            $request->image->move('postimage',$imagename);
            $post->image=$imagename; 
            }
            $post->save();
            return redirect()->back()->with('message','Post Added Successfully');
            }

            public function show_post()
            {
                $posts=Post::all();
                return view('admin.show_post',compact('posts'));

            }
            public function delete_post($id)
            {
                $post=Post::find($id);
                $post->delete();
                return redirect()->back()->with('message','Post Deleted Successfully');
            }
            public function edit_post($id)
            {
                $post=Post::find($id);
                return view('admin.edit_post',compact('post'));
            }

            public function update_post(Request $request,$id)
            {
                $post=Post::find($id);
                $post->title=$request->title;
                $post->description=$request->description;
                $image=$request->image;
                if ($image) {
                $imagename=time().'.'.$image->getClientOriginalExtension();
                $request->image->move('postimage',$imagename);
                $post->image=$imagename; 
                }
                $post->save();
                return redirect()->back()->with('message','Post Updated Successfully');
            }

    public function accept_post($id)
    {
        $data=Post::find($id);
        $data->post_status='active';
        $data->save();
        return redirect()->back()->with('message','Post Accepted Successfully');

    }
    public function reject_post($id)
    {
        $data=Post::find($id);
        $data->post_status='rejected';
        $data->save();
        return redirect()->back()->with('message','Post Rejected Successfully');
    }

    public function user_page()
    {
        $users = User::all(); // Fetch all users from the database
        return view('admin.user_page', compact('users')); // Pass users to the view
    }

    // Add a new user
    public function create_user()
{
    return view('admin.create_user'); // Make sure this points to the correct blade file
}
    public function add_user(Request $request)
    {
        // Validate the input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'nullable|string|max:15',
            'password' => 'required|string|min:8',
        ]);

        // Create a new user
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->usertype = $request->usertype ?? 'user'; // Default to 'user' if not provided
        $user->userstatus = $request->userstatus ?? 'student'; // Default to 'student'
        $user->password = Hash::make($request->password); // Hash the password
        $user->save();

        return redirect()->back()->with('message', 'User added successfully!');
    }

    // Show a single user for editing
    public function edit_user($id)
    {
        $user = User::find($id); // Find the user by ID

        if (!$user) {
            return redirect()->back()->with('message', 'User not found!');
        }

        return view('admin.edit_user', compact('user')); // Pass the user to the edit view
    }

    // Update an existing user
    public function update_user(Request $request, $id)
    {
        // Validate the input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'phone' => 'nullable|string|max:15',
            'password' => 'nullable|string|min:8',
        ]);

        // Find the user and update their information
        $user = User::find($id);

        if (!$user) {
            return redirect()->back()->with('message', 'User not found!');
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->usertype = $request->usertype ?? $user->usertype; // Keep existing value if not provided
        $user->userstatus = $request->userstatus ?? $user->userstatus;
        if ($request->password) {
            $user->password = Hash::make($request->password); // Update password only if provided
        }
        $user->save();

        return redirect()->back()->with('message', 'User updated successfully!');
    }

    // Delete a user
    public function delete_user($id)
    {
        $user = User::find($id);

        if (!$user) {
            return redirect()->back()->with('message', 'User not found!');
        }

        $user->delete(); // Delete the user
        return redirect()->back()->with('message', 'User deleted successfully!');
    }

    // Show all users (used for additional purposes if needed)
    public function show_user()
    {
        $users = User::all(); // Fetch all users
        return view('admin.show_user', compact('users'));
    }


    public function tutorial_page()
{
    // Fetch all tutorials
    $tutorials = Tutorial::all();
    return view('admin.tutorial_page', compact('tutorials'));
}

public function delete_tutorial($id)
{
    $tutorial = Tutorial::find($id);
    if ($tutorial) {
        $tutorial->delete();
        return redirect()->back()->with('message', 'Tutorial deleted successfully!');
    }
    return redirect()->back()->with('error', 'Tutorial not found!');
}

}
