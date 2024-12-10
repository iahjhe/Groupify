<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\Tutorial;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\Group;
use App\Models\Message;


class HomeController extends Controller
{
    // Method to handle the main index logic
    public function index()
{
    if (Auth::check()) { // Check if user is authenticated
        $post = Post::where('post_status','=', 'active')->get();
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


    // Method to handle the homepage view
    public function homepage()
    {
        $post = Post::where('post_status','=', 'active')->get();
        $posts = Post::latest()->take(3)->get();
        return view('home.homepage', compact('post')); 
    }
    public function post_details($id){
        $post=Post::find($id);
        return view('home.post_details',compact('post'));
    }
    public function create_post(){
        return view('home.create_post');
    }
// Controller Method for Home Page


    public function services()
{
    $post = Post::where('post_status','=', 'active')->get();
    
    return view('home.services',compact('post')); // Ensure the view name matches
}


    public function add_post(Request $request){
        $user=Auth::user();
        $user_id=$user->id;
        $name=$user->name;
        $usertype=$user->usertype;
        $post=new Post;
        $post->title=$request->title;
        $post->description=$request->description;
        $post->user_id=$user_id;
        $post->name=$name;
        $post->usertype=$usertype;
        $post->post_status= 'pending';
        $image=$request->image;
        if ($image) {
        $imagename=time().'.'.$image->getClientOriginalExtension();
        $request->image->move('postimage',$imagename);
        $post->image=$imagename;
        }
        $post->save();
        return redirect()->back()->with('message','Post Added Successfully');
    }
    public function my_post(){
        $user=Auth::user();
        $user_id=$user->id;
        $data=Post::where('user_id','=',$user_id)->get();
        return view('home.my_post',compact('data'));
    }
    public function delete_mypost($id)
{
    // Find the post by its ID
    $post = Post::find($id);

    // Check if the post exists before attempting to delete
    if ($post) {
        $post->delete();
        return redirect()->back()->with('message', 'Post Deleted Successfully');
    } else {
        return redirect()->back()->with('error', 'Post not found');
    }
}

    public function edit_mypost($id){
        $data=Post::find($id);
        return view('home.edit_mypost',compact('data'));
    }

    public function update_mypost(Request $request,$id){
        $data=Post::find($id);
        $data->title=$request->title;
        $data->description=$request->description;
        $image=$request->image;
        if ($image) {
        $imagename=time().'.'.$image->getClientOriginalExtension();
        $request->image->move('postimage',$imagename);
        $data->image=$imagename; 
        }
        $data->save();
        return redirect()->back()->with('message','Post Updated Successfully');
    }

    public function create_tutorial(){
        return view('home.create_tutorial');
    }
    public function add_tutorial(Request $request)
    {
        $user = Auth::user();
        $user_id = $user->id;
    
        $tutorial = new Tutorial;
        $tutorial->title = $request->title;
        $tutorial->description = $request->description;
        $tutorial->schedule = $request->schedule;
        $tutorial->mode = $request->mode;
        $tutorial->rate = $request->rate;
        $tutorial->students = $request->students;
        $tutorial->user_id = $user_id;  // Add this line to set the user_id
        
 
    
        // Save the tutorial
        $tutorial->save();
    
        return redirect()->back()->with('message', 'Tutorial Added Successfully');
    }
    public function my_tutorials(){
        $user = Auth::user();
        $user_id = $user->id;
    
        $tutorials = Tutorial::where('user_id', $user_id)->get();
    
        return view('home.my_tutorials', compact('tutorials'));
    }
    public function delete_tutorial($id)
{
    // Find the tutorial by its ID
    $tutorial = Tutorial::find($id);

    // Check if the tutorial exists before attempting to delete
    if ($tutorial) {
        $tutorial->delete();
        return redirect()->back()->with('message', 'Tutorial Deleted Successfully');
    } else {
        return redirect()->back()->with('error', 'Tutorial not found');
    }
    
}
public function tutors()
{
    $currentDateTime = Carbon::now();

    // Retrieve tutorials that still have students and are not past the schedule
    $tutorials = Tutorial::where('students', '>', 0)
                         ->where('schedule', '>=', $currentDateTime)
                         ->with('user') // Eager load the user for performance
                         ->paginate(9); // Use paginate to allow pagination controls

    return view('home.tutors', compact('tutorials'));
}


public function tutor_details($id)
{
    $tutorial = Tutorial::findOrFail($id); // Retrieve tutorial by ID
    return view('home.tutor_details', compact('tutorial'));
}
public function tutorDetails($id)
{
    $tutorial = Tutorial::with('user')->findOrFail($id);
    return view('home.tutor_details', compact('tutorial'));
}

public function hireTutorForm($id)
{
    $tutorial = Tutorial::findOrFail($id);
    return view('home.hire_tutor_form', compact('tutorial'));
}

public function hireTutor(Request $request, $id)
{
    $tutorial = Tutorial::findOrFail($id);

    // Validate the form data
    $request->validate([
        'name' => 'required|string|max:255',
        'year_level' => 'required|string|max:255',
        'payment' => 'required|numeric|min:1',
    ]);

    // Check if the student already hired this tutorial
    $existingHire = DB::table('hirings')
        ->where('tutorial_id', $tutorial->id)
        ->where('name', $request->name) // Assuming `name` uniquely identifies the student
        ->first();

    if ($existingHire) {
        return redirect()->back()->with('error', 'You have already hired this tutor.');
    }

    // Decrement the student count
    if ($tutorial->students > 0) {
        $tutorial->students -= 1;
        $tutorial->save();

        // Insert hire details into the `hirings` table
        DB::table('hirings')->insert([
            'tutorial_id' => $tutorial->id,
            'name' => $request->name,
            'year_level' => $request->year_level,
            'payment' => $request->payment,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Redirect to the tutorial details page
        return redirect('/tutorial_details/'.$tutorial->id)
            ->with('message', 'You have successfully hired the tutor!');
    } else {
        return redirect()->back()->with('error', 'No slots available for this tutorial.');
    }
}

public function group()
{
    $groups = Group::with('user')->paginate(9); // Fetch groups with creator information
    return view('home.group', compact('groups')); // Pass the groups to the view
}

public function create_group(){
    return view('home.create_group');
}
public function add_group(Request $request){
    $user = Auth::user();
    $user_id = $user->id;
    $group = new Group;
    $group->name = $request->name;
    $group->description = $request->description;
    $group->user_id = $user_id;  // Add this line to set the user_id
    $group->save();
    return redirect()->route('groups')->with('message', 'Group Added Successfully');
}
public function showGroups()
{
    $groups = Group::with('user')->paginate(9); // Fetch groups with their creator
    return view('home.group', compact('groups')); // Correct view path
}


public function joinGroup($id)
{
    $user = Auth::user();

    // Add the user to the group (you'll need a pivot table for this)
    $group = Group::find($id);
    $group->members()->attach($user->id);

    return redirect()->back()->with('message', 'You have joined the group successfully.');
}

public function join_group($group_id)
{
    // Get the currently logged-in user
    $user = Auth::user();

    // Find the group
    $group = Group::find($group_id);

    // Check if the group exists
    if (!$group) {
        return redirect()->route('groups')->with('error', 'Group not found.');
    }

    // Check if the user is already a member of the group
    if ($group->users()->where('user_id', $user->id)->exists()) {
        return redirect()->route('groups')->with('error', 'You are already a member of this group.');
    }

    // Attach the user to the group
    $group->users()->attach($user->id);

    // Redirect to the group page
    return redirect()->route('show_group', ['group_id' => $group->id])->with('message', 'You have successfully joined the group!');
}

public function show_group($group_id)
{
    // Get the group details along with messages
    $group = Group::find($group_id);

    // Get the messages related to the group
    $messages = Message::where('group_id', $group_id)->get();

    // Return the group view with messages
    return view('home.show', compact('group', 'messages'));
}

public function send_message(Request $request, $group_id)
{
    // Get the currently logged-in user
    $user = Auth::user();

    // Validate the message input
    $request->validate([
        'message' => 'required|string|max:1000'
    ]);

    // Create a new message
    $message = new Message;
    $message->user_id = $user->id;
    $message->group_id = $group_id;
    $message->message = $request->message;
    $message->save();

    // Redirect back to the group page with a success message
    return back()->with('message', 'Message sent successfully!');
}
public function enter_group($group_id)
{
    // Get the currently logged-in user
    $user = Auth::user();
    $messages = Message::where('group_id', $group_id)->get();

    // Find the group
    $group = Group::find($group_id);

    // Check if the group exists
    if (!$group) {
        return redirect()->route('groups')->with('error', 'Group not found.');
    }

    // Check if the user is a member of the group
    if (!$group->users()->where('user_id', $user->id)->exists()) {
        return redirect()->route('groups')->with('error', 'You are not a member of this group.');
    }

    // Render a view for the group
    return view('home.show', compact('group', 'messages'));
}


}
