<?php

namespace App\Http\Controllers;

use App\Models\Advert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdvertController extends Controller
{
    public function show_advert() {
        $adverts = Advert::orderBy('id', 'DESC')->paginate(10);

        return view('admin.adverts', compact('adverts'));
    }


    public function add_advert() {
   

        return view('admin.add-adverts');
    }

    public function store_advert(Request $request) {
        $validated = [
            'title' => 'required|string|max:255',
            'video_path' => 'nullable|file|mimetypes:video/mp4,video/quicktime|max:50000',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'display_duration' => 'required|integer|min:1|max:60',
        ];

        $advert = new Advert();

        $advert->title = $request->title;
        $advert->display_duration = $request->display_duration;

        // Video
        if($request->hasFile('video_path')) {
            $advert->video_path = $request->file('video_path')->store('adverts/videos', 'public');
        }

        // Image
        if($request->hasFile('image_path')) {
            $advert->image_path = $request->file('image_path')->store('adverts/images', 'public');
        }

        $advert->save();

        return redirect()->route('show.advert')->with('success', 'Advert created successfully');
    }

    public function edit_advert($id) {
        $advert = Advert::find($id);

        return view('admin.edit-advert', compact('advert'));
    }

    public function update_advert(Request $request, $id) {
        $validated = [
            'title' => 'required|string|max:255',
            'video_path' => 'nullable|file|mimetypes:video/mp4,video/quicktime|max:50000',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'display_duration' => 'required|integer|min:1|max:60',
        ];

        $advert = Advert::findOrFail($id);

        $advert->title = $request->title;
        $advert->display_duration = $request->display_duration;

    // Handle Video Upload (Delete old if exists)
    if ($request->hasFile('video_path')) {
        if ($advert->video_path) {
            Storage::disk('public')->delete($advert->video_path);
        }
        $advert->video_path = $request->file('video_path')->store('adverts/videos', 'public');
    }

    // Handle Image Upload (Delete old if exists)
    if ($request->hasFile('image_path')) {
        if ($advert->image_path) {
            Storage::disk('public')->delete($advert->image_path);
        }
        $advert->image_path = $request->file('image_path')->store('adverts/images', 'public');
    }

        $advert->save();

        return redirect()->route('show.advert')->with('success', 'Advert created successfully');
    }

    public function delete_advert($id) {
        $advert = Advert::find($id)->delete();

        return redirect()->back()->with('success', 'Career deleted successfully');
    }
}
