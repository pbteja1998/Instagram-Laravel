<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use App\Image;
use App\Like;
use App\USer;

class ImageController extends Controller
{
    public function index(){
        $users = request()->user()->following;
        $i = collect([]);
        foreach($users as $user){
            $user_images = $user->images;
            foreach($user_images as $image){
                $i->prepend($image);
            }
        }
        $images = $i;
        return view('images.index',compact('images'));
    }

    public function add(Request $request){
        $image = $request->file('image');
        $extension = $image->getClientOriginalExtension();
        Storage::disk('local')->put('public/'.$image->getFilename().'.'.$extension,  File::get($image));
        /**
         * @var \App\User $user
         */
        $user = $request->user();

        $entry = $user->images()->create([
            'mime'=>$image->getClientMimeType(),
            'original_name'=>$image->getClientOriginalName(),
            'name'=> $image->getFilename().'.'.$extension
        ]);

        return back();
    }

    public function getLikes(Image $image){
        return count($image->likes);
    }

}

