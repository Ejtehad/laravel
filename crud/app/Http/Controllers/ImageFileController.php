<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Image;


class ImageFileController extends Controller
{

    public function index()
    {
        return view('imageUpload');
    }

    public function imageFileUpload(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|image|mimes:jpg,jpeg,png,gif,svg|max:4096',
        ]);

        $image = $request->file('file');
        $input['file'] = time().'.'.$image->getClientOriginalExtension();

        $imgFile = Image::make($image->getRealPath());

        $imgFile->insert(public_path('/uploads/logo.jpg'), 'bottom-right', 100, 100)->text('© 2016-2020 positronX.io - All Rights Reserved', 120, 100, function($font) {
                               $font->size(78);
                               $font->color('#00000');
                               $font->align('center');
                               $font->valign('bottom');
                               $font->angle(45);
                           })->save(public_path('/uploads').'/'.$input['file']);

        return back()
        	->with('success','File successfully uploaded.')
        	->with('fileName',$input['file']);
    }
}
