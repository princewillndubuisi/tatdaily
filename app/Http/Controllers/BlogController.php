<?php

namespace App\Http\Controllers;

use DOMDocument;
use DOMElement;
use App\Models\Tag;
use Illuminate\Support\Str;
use App\Models\Advert;
use App\Models\Post;
use App\Models\User;
use App\Models\Click;
use App\Models\Career;
use App\Models\Category;
use App\Mail\VerifyEmail;
use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;

class BlogController extends Controller
{

    public function home() {
        if (Auth::id()) {
            $post = Post::where('post_status', '=', 'active')->orderBy('created_at', 'DESC')->paginate(4);

            $category = Category::all();

            $ten = Post::where('post_status', '=', 'active')->latest()->take(4)->get();

            $adverts = Advert::where('is_active', true)->get();

            $user = User::get();

            $users = User::count();

            $blogs = Post::count();

            $usertype = Auth::user()->usertype;

            switch ($usertype) {
                case 'user':
                    return view('welcome', compact('post', 'category', 'ten', 'adverts'));
                case 'admin':
                    return view('admin.admin', compact('user','users', 'blogs'));
                case    'editor':
                    return view('welcome', compact('post', 'category', 'ten', 'adverts'));
                default:
                    return redirect()->back();
            }
        }
    }

    // Read post
    public function read_post($id) {
        $post = Post::find($id);

        $otherPosts = Post::where('user_id', $post->user_id)
                            ->where('id', '!=', $id)
                            ->latest()
                            ->take(5)
                            ->get();

        return view('read_post',compact('post', 'otherPosts'));
    }

    // Category post
    public function category_post($id) {
        $category = Category::with('posts')->findOrFail($id); // eager load posts

        $post = $category->posts()
        ->where('post_status', 'active')
        ->orderBy('created_at', 'DESC')
        ->paginate(4);

        return view('category_post', compact('category', 'post'));
    }


    // User profile
    public function profiles() {
        $user = Auth::user();

        $userid = $user->id;

        $categories = Category::all();

        $data = Post::where('user_id', '=', $userid)
                        ->with('category')
                        ->orderBy('id', 'DESC')
                        ->paginate(5);

        return view('user.profiles', compact('data', 'user', 'categories'));
    }

    // User show post
    public function welcome() {
        $post = Post::where('post_status', '=', 'active')->orderBy('created_at', 'DESC')->paginate(4);

        $category = Category::all();

        $adverts = Advert::where('is_active', true)->get();

        $ten = Post::where('post_status', '=', 'active')->latest()->take(4)->get();

        return view('welcome', compact('post', 'category', 'ten', 'adverts'));
    }

    // User Create postpage
    public function create_post(){
        $categories = Category::all();
        return view('user.create_post', compact('categories'));
    }

    // Upload Image
    public function upload_image(Request $request)
    {
        if ($request->hasFile('upload')) {
            $file = $request->file('upload');

            // Validation
            $allowedMimeTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
            $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
            $maxFileSize = 2 * 1024 * 1024; // 2MB

            $mimeType = $file->getMimeType();
            $extension = strtolower($file->getClientOriginalExtension());

            if (!in_array($mimeType, $allowedMimeTypes) || !in_array($extension, $allowedExtensions)) {
                return response()->json([
                    'uploaded' => 0,
                    'error' => ['message' => 'Only image files are allowed.']
                ]);
            }

            if ($file->getSize() > $maxFileSize) {
                return response()->json([
                    'uploaded' => 0,
                    'error' => ['message' => 'Image size must be less than 2MB.']
                ]);
            }

            // Store in `storage/app/public/uploads`
            $filename = time() . '_' . Str::random(10) . '.' . $extension;
            $path = $file->storeAs('public/uploads', $filename); // saves in storage/app/public/uploads

            // Access URL via storage link (public/storage/uploads/...)
            $url = asset('storage/uploads/' . $filename);

            return response()->json([
                'uploaded' => 1,
                'fileName' => $filename,
                'url' => $url
            ]);
        }

        return response()->json([
            'uploaded' => 0,
            'error' => ['message' => 'No image file was uploaded.']
        ]);
    }

    // User post
    public function user_post(Request $request) {
        $validate = $request->validate([
            'title' => ['required'],
            'description' => ['required'],
            'body' => ['required'],
            'category_id' => ['required', 'exists:categories,id'],
        ]);

        $post = new Post();
        $post->title = $request->title;
        $post->description = $request->description;
        $post->body = $request->body;
        $post->category_id = $request->category_id;
        $post->post_status = 'active';

        $user = Auth::user();
        $post->user_id = $user->id;
        $post->name = $user->name;
        $post->usertype = $user->usertype;
        $post->post_status = 'pending';

        $post->save();

        // Extract Images and Store in `post.image`
        $dom = new DOMDocument();
        @$dom->loadHTML($request->body, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $images = $dom->getElementsByTagName('img');

        $imageArray = [];
        foreach ($images as $img) {
            if ($img instanceof DOMElement) {
                $src = $img->getAttribute('src');
                if (strpos($src, 'storage/uploads/') !== false) {
                    $imageArray[] = $src;
                }
            }
        }
        if (!empty($imageArray)) {
            $post->image = implode(',', $imageArray);
        }

        // Extract Videos from CKEditor (Handles <oembed> and <iframe>)
        $videoArray = [];

        // Extract from <oembed> (used by CKEditor for YouTube embeds)
        $oembeds = $dom->getElementsByTagName('oembed');
        foreach ($oembeds as $oembed) {
            if ($oembed instanceof DOMElement) {
                $videoSrc = $oembed->getAttribute('url');
                if (!empty($videoSrc)) {
                    // Convert YouTube URL to Embed Format
                    if (strpos($videoSrc, 'youtube.com/watch?v=') !== false) {
                        $videoSrc = str_replace("watch?v=", "embed/", $videoSrc);
                    }
                    $videoArray[] = $videoSrc;
                }
            }
        }

        // Extract from <iframe> (some embeds use this format)
        $iframes = $dom->getElementsByTagName('iframe');
        foreach ($iframes as $iframe) {
            if ($iframe instanceof DOMElement) {
                $videoSrc = $iframe->getAttribute('src');
                if (!empty($videoSrc)) {
                    $videoArray[] = $videoSrc;
                }
            }
        }

        // Save extracted video URLs in `post.video`
        if (!empty($videoArray)) {
            $post->video = implode(',', $videoArray);
        }

        $post->save();

        return redirect()->route('profiles')->with('success', 'Post Added Successfully');
    }

    // User delete post
    public function user_post_del($id) {
        $data = Post::find($id)->delete();

        return redirect()->back()->with('success', 'Post deleted successfully');
    }

    // User update post
    public function user_post_edit($id) {
        $data = Post::find($id);

        $categories = Category::all();

        return view('user.edit_post', compact('data', 'categories'));
    }

    public function user_post_update(Request $request, $id) {
        $validate = $request->validate([
            'title' => ['required'],
            'description' => ['required'],
            'body' => ['required'],
            'category_id' => ['required', 'exists:categories,id'],
        ]);

        $data = Post::findOrFail($id);
        $data->title = $request->title;
        $data->description = $request->description;
        $data->body = $request->body;
        $data->category_id = $request->category_id;

        // Extract Images and Update `post.image`
        $dom = new DOMDocument();
        @$dom->loadHTML($request->body, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $images = $dom->getElementsByTagName('img');

        $imageArray = []; // Store multiple images
        foreach ($images as $img) {
            if ($img instanceof DOMElement) {
                $src = $img->getAttribute('src');
                if (strpos($src, 'storage/uploads/') !== false) {
                    $imageArray[] = $src;
                }
            }
        }
        $data->image = !empty($imageArray) ? implode(',', $imageArray) : null;

        // Extract Videos and Update `post.video`
        $videos = $dom->getElementsByTagName('iframe'); // Assuming YouTube/Vimeo embeds
        $videoArray = []; // Store multiple videos
        foreach ($videos as $video) {
            if ($video instanceof DOMElement) {
                $videoSrc = $video->getAttribute('src');
                if (strpos($videoSrc, 'uploads/') !== false) {
                    $videoArray[] = $videoSrc;
                }
            }
        }
        $data->video = !empty($videoArray) ? implode(',', $videoArray) : null;

        $data->save();

        return redirect()->route('profiles')->with('success', 'Post Updated Successfully');
    }

    // public function edit_user($id) {
    //    $userId = User::find($id);
    //     return view('user.profiles',['userId' => $id]);
    // }

    // Picture Update
    public function update_picture(Request $request) {
        $validate = $request->validate([
            'photo' => ['file', 'mimes:jpeg,png,jpg,gif,mp4,mov,ogg,qt', 'max:2048'],
        ]);

        $user = Auth::user();

        $photoPath = $request->file('photo')->storeAs('photos', time() . '.' . $request->file('photo')->getClientOriginalExtension(), 'public');

        // Update the user's photo path in the database
        $user->photo = $photoPath;
        $user->save();

        // Optionally, redirect back with a success message
        return redirect()->back();

    }

    // Career
    public function career(Request $request)
    {
        // Start building the query
        $query = Career::where('is_active', true)->with('tags')->latest();

        // Apply search filter
        if ($request->has('s')) {
            $searchQuery = trim($request->get('s'));

            $query->where(function ($builder) use ($searchQuery) {
                $builder
                    ->orWhere('title', 'like', "%{$searchQuery}%")
                    ->orWhere('company', 'like', "%{$searchQuery}%")
                    ->orWhere('location', 'like', "%{$searchQuery}%");
            });
        }

        // Apply tag filter
        if ($request->has('tag')) {
            $tag = $request->get('tag');
            $query->whereHas('tags', function ($builder) use ($tag) {
                $builder->where('slug', $tag);
            });
        }

        // Execute the query to get the results
        $careers = $query->get();

        // Pass the tags to the view (if needed)
        $tags = Tag::all();

        return view('career.index', compact('careers', 'tags'));
    }

    // Show Career
    public function show_career(Career $career, Request $request) {
        return view('career.show', compact('career'));
    }

    // Apply Career
    public function link_career(Career $career, Request $request) {
        $career->clicks()
            ->create([
                'user_agent' => $request->userAgent(),
                'ip' => $request->ip()
            ]);

        return redirect()->to($career->apply_link);
    }

    // Apply Career
    public function apply_career() {
        return view ('career.apply');
    }

    // Save application
    public function save_application(Request $request ) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'resume' => 'required|file|mimes:jpg,jpeg,png,pdf,doc,docx|max:2048',
            'phone' => 'nullable|string|max:20',
            'cover_letter' => 'nullable|string',
            'files.*' => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx|max:2048', // Validation for multiple files
        ]);

        // Handle file upload
        $resumePath = $request->file('resume')->store('resumes', 'public');

        // Handle multiple files upload
        $uploadedFiles = [];
        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
            $uploadedFiles[] = $file->store('multiplefiles', 'public');
            }
        }

        // Save the application
        $career = new Application();

        $career->user_id = auth()->id();
        $career->name = $request->name;
        $career->email = $request->email;
        $career->phone = $request->phone;
        $career->cover_letter = $request->cover_letter;
        $career->resume = $resumePath;
        $career->files = json_encode($uploadedFiles);


        $career->save();

        $name = $request->name;
        $email = $request->email;

        Mail::to($request->email)->send(new VerifyEmail($name, $email));

        return redirect()->back()->with('success', 'Your application has been submitted successfully.');
    }
}
