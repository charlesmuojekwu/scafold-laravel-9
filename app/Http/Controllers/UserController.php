<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index() 
    {
        $data = [
            'name' => 'Franon',
            'email' => 'on52@bitfumes.com',
            'password' => 'password'
        ];

        //User::create($data);

        $user = User::all();

        return $user;
    }


    public function fileUpload(Request $request)
    {
        //dd($request->image->extension());
        if($request->hasFile('image'))
        {
            //$path = $request->image->store('images','public');

            $fileName = $request->image->getClientOriginalName();
            $path = $request->image->storeAs('images',$fileName,'public');

            // Check if profile image exists and delete
            if(auth()->user()->avatar)
            {
                Storage::delete('/public/'.auth()->user()->avatar);
            }

            auth()->user()->update(['avatar' => $path]);

            return redirect()->back()->with('success', 'Image Uploaded');
        }

            
        return redirect()->back()->with('error', 'Image Not Uploaded');
    }
}
