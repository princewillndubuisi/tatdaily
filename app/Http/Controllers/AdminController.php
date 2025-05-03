<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use DOMDocument;
use DOMElement;
use App\Models\Tag;
use App\Models\Post;
use App\Models\User;
use App\Models\Career;
use App\Models\Category;
use App\Models\Application;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function dashboard_page() {
        $users = User::count();

        $user = User::get();

        $blogs = Post::count();

        return view('admin.admin', compact('users', 'blogs', 'user'));
    }

    public function post_page() {
        $category = Category::all();
        return view('admin.post_page', compact('category'));
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


    // Add Post
    public function add_post(Request $request) {
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
                        $videoId = explode('v=', parse_url($videoSrc, PHP_URL_QUERY))[1];
                        $videoId = explode('&', $videoId)[0]; // Remove any extra params
                        $videoSrc = 'https://www.youtube.com/embed/' . $videoId;
                    } elseif (strpos($videoSrc, 'youtu.be/') !== false) {
                        $path = parse_url($videoSrc, PHP_URL_PATH); // gets /IKKzTJT8dQM
                        $videoId = ltrim($path, '/');
                        $videoSrc = 'https://www.youtube.com/embed/' . $videoId;
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

        return redirect()->route('show.post')->with('success', 'Post Added Successfully');
    }





    // Show post
    public function show_post() {
        $posts = Post::with('category')->orderBy('id', 'DESC')->paginate(10);

        // foreach ($posts as $post) {
        //     $post->images = DB::table('images')->where('post_id', $post->id)->get(); // Fetch images for each post
        // }

        return view('admin.show_post', compact('posts'));
    }

    // Edit post
    public function edit_page($id) {
        $post = Post::find($id);

        $categories = Category::all();

        return view('admin.edit_page', compact('post', 'categories'));
    }

    // Update post
    public function update_post(Request $request, $id)
    {
        $validate = $request->validate([
            'title' => ['required'],
            'description' => ['required'],
            'body' => ['required'],
            'category_id' => ['required', 'exists:categories,id'],
        ]);

        $post = Post::findOrFail($id);
        $post->title = $request->title;
        $post->description = $request->description;
        $post->body = $request->body;
        $post->category_id = $request->category_id;

        // Extract Images
        $dom = new DOMDocument();
        @$dom->loadHTML($request->body, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

        // Images
        $imageArray = [];
        foreach ($dom->getElementsByTagName('img') as $img) {
            if ($img instanceof DOMElement) {
                $src = $img->getAttribute('src');
                if (strpos($src, 'storage/uploads/') !== false) {
                    $imageArray[] = $src;
                }
            }
        }
        $post->image = !empty($imageArray) ? implode(',', $imageArray) : null;

        // Videos (support both iframe and oembed)
        $videoArray = [];

        // <iframe> videos
        foreach ($dom->getElementsByTagName('iframe') as $video) {
            if ($video instanceof DOMElement) {
                $src = $video->getAttribute('src');
                $videoArray[] = $src;
            }
        }

        // <oembed> videos (like from YouTube)
        foreach ($dom->getElementsByTagName('oembed') as $embed) {
            if ($embed instanceof DOMElement) {
                $url = $embed->getAttribute('url');
                $videoArray[] = $url;
            }
        }

        $post->video = !empty($videoArray) ? implode(',', $videoArray) : null;

        $post->save();

        return redirect()->route('show.post')->with('success', 'Post Updated Successfully');
    }



    // Delete post
    public function delete_post($id) {
        $post = Post::find($id)->delete();

        return redirect()->back()->with('success', 'Post Deleted Successfully');
    }

    // Accept User Post
    public function accept_post($id) {
        $post = Post::find($id);

        $post->post_status = 'active';

        $post->save();

        return redirect()->back()->with('success', 'Status updated to active');
    }


    // Reject User post
    public function reject_post($id) {
        $post = Post::find($id);

        $post->post_status = 'rejected';

        $post->save();

        return redirect()->back()->with('success', 'Status Rejected ');
    }

    // Category

    // Show category
    public function show_category() {
        $category = Category::all();

        return view('admin.category_page', compact('category'));
    }

    // Category Page
    public function category_page() {
        return view('admin.category_add_page');
    }

    // Add category
    public function add_category(Request $request) {
        $validate = $request->validate([
            'title' => ['required'],
        ]);

        $category = new Category();

        $category->title = $request->title;

        $category->save();

        return redirect()->route('show.category')->with('success', 'Category added successfully');
    }


    // Edit category
    public function edit_category_page($id) {
        $category = Category::find($id);

        return view('admin.category_edit_page', compact('category'));
    }

    // Update category
    public function update_category(Request $request, $id) {
        $validate = $request->validate([
            'title' => ['required'],
        ]);

        $category = Category::find($id);

        $category->title = $request->title;

        $category->save();

        return redirect()->route('show.category')->with('success', 'Category updated successfully');
    }

    // Delete category
    public function delete_category($id) {
        $category = Category::find($id)->delete();

        return redirect()->back()->with('success', 'Category deleted successfully');
    }

    // Career page
    public function show_career() {
        $careers = Career::orderBy('id', 'DESC')->paginate();

        return view('admin.career_page', compact('careers'));
    }

    // Add Career
    public function add_career_page() {
        return view('admin.career_add_page');
    }

    // Store Career
    public function store_career(Request $request) {
        $request->validate([
            'title' => 'required',
            'company' => 'required',
            'logo' => 'required|file|max:2048',
            'location' => 'required',
            'apply_link' => 'required|url',
            'content' => 'required',
        ]);

        $career = new Career();

        $career->user_id = auth()->id();
        $career->title = $request->title;
        $career->slug = Str::slug($request->title) . '-' . rand(1111, 9999);
        $career->company = $request->company;
        $career->logo = basename($request->file('logo')->store('public'));
        $career->location = $request->location;
        $career->apply_link = $request->apply_link;
        $career->content = $request->content;
        $career->is_active = true;
        $career->is_highlighted = $request->filled('is_highlighted');

        $career->save();

        foreach(explode(',', $request->tags) as $requestTag) {
            $tag = Tag::firstOrCreate([
                'slug' => Str::slug(trim($requestTag))
            ], [
                'name' => ucwords(trim($requestTag))
            ]);

            $tag->careers()->attach($career->id);
        }

        return redirect()->route('show.career')->with('success', 'Career added successfully');
    }

    // Edit Career
    public function edit_career($id) {
        $career = Career::find($id);

        return view('admin.career_edit_page', compact('career'));
    }

    // Update Career
    public function update_career(Request $request) {
        $request->validate([
            'title' => 'required',
            'company' => 'required',
            'logo' => 'file|max:2048',
            'location' => 'required',
            'apply_link' => 'required|url',
            'content' => 'required',
        ]);

        $career = Career::find($request->id);

        $career->user_id = auth()->id();
        $career->title = $request->title;
        $career->slug = Str::slug($request->title) . '-' . rand(1111, 9999);
        $career->company = $request->company;
        $career->location = $request->location;
        $career->apply_link = $request->apply_link;
        $career->content = $request->content;
        $career->is_active = true;
        $career->is_highlighted = $request->filled('is_highlighted');

        // Check if a new logo was uploaded
        if ($request->hasFile('logo')) {
            $career->logo = basename($request->file('logo')->store('public'));
        }

        $career->save();

        $career->tags()->detach();
        foreach(explode(',', $request->tags) as $requestTag) {
            $tag = Tag::firstOrCreate([
                'slug' => Str::slug(trim($requestTag))
            ], [
                'name' => ucwords(trim($requestTag))
            ]);

            $tag->careers()->attach($career->id);
        }

        return redirect()->route('show.career')->with('success', 'Career updated successfully');
    }

    // Delete Career
    public function delete_career($id) {
        $career = Career::find($id)->delete();

        return redirect()->back()->with('success', 'Career deleted successfully');
    }

    // Applied career
    public function applied_career() {
        $careers = Application::orderBy('id', 'DESC')->paginate();

        return view('admin.career_applied',compact('careers'));
    }

    public function downloadResume($id) {
        $career = Application::findOrFail($id);

        // Get the resume file path
        $filePath = $career->resume;

        // Check if the file exists
        if (!Storage::disk('public')->exists($filePath)) {
            return back()->with('error', 'Resume file not found.');
        }

        // Return the file as a download
        return Storage::disk('public')->download($filePath);
    }

    public function downloadfiles($id) {
        $career = Application::findOrFail($id);

        // Decode the JSON-encoded file paths
        $filePaths = json_decode($career->files, true);

        if (empty($filePaths)) {
            return back()->with('error', 'No files found for this application.');
        }

        // Create a temporary ZIP file
        $zipFileName = 'application_files_' . $career->id . '.zip';
        $zipPath = storage_path('app/public/' . $zipFileName);
        $zip = new \ZipArchive();

        if ($zip->open($zipPath, \ZipArchive::CREATE | \ZipArchive::OVERWRITE) !== true) {
            return back()->with('error', 'Unable to create ZIP file.');
        }

        // Add files to the ZIP
        foreach ($filePaths as $filePath) {
            $fileFullPath = storage_path('app/public/' . $filePath);

            if (file_exists($fileFullPath)) {
                $zip->addFile($fileFullPath, basename($filePath));
            }
        }

        $zip->close();

        // Return the ZIP file as a download
        return response()->download($zipPath)->deleteFileAfterSend(true);
    }

    public function delete_applied_career($id) {
        $career = Application::find($id)->delete();

        return redirect()->back()->with('success', 'Career deleted successfully');
    }
}
