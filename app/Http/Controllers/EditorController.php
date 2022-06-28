<?php

namespace App\Http\Controllers;

use App\Models\Template;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Image;

class EditorController extends Controller
{
    public function index()
    {
        return view('editor');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'type' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => json_decode(json_encode($validator->errors()), true),
            ]);
        } else {
            $save = new Template();
                $reImage = null;
            if($request->has('temp_image')){
                $image=$request->file('temp_image');
                $reImage=time().'.'.$image->getClientOriginalExtension();
                $dest=public_path('/imgs');
                $image->move($dest,$reImage);}

       // echo $request->input('editor');//editor is the name of text area
            $save->type = $request->input('type');
            $save->heading = $request->input('heading');
            $save->content = $request->input('topic_details');
            $save->image_name = $reImage;
            $save->title = $request->input('title');
            $save->image_discription = $request->input('img_details');
            $save->save();
            return response()->json([
                'status' => 200,
                'massage' => 'Added successfully'
            ]);
        }
    }

    function update(request $req,)
    {
        $update = Template::find($req->id);
        $update->content = $req->editor;
        $isSave = $update->save();
        // return redirect('admin/user');

        if ($isSave) {
            return response()->json(['status' => 200, 'msg' => 'User info updated successfully']);
        } else {
            return response()->json(['status' => 100, 'msg' => 'Data not found']);
        }
    }

    public function upload(Request $request,)
    {
        if ($request->hasFile('upload')) {
            //get file name with extention 
            $filenamewithextension = $request->file('upload')->getClientOriginalName();
            //get file name without extention
            $filename = pathinfo($filenamewithextension,PATHINFO_FILENAME);
            //GET FILE EXTENTION
            $extension = $request ->file('upload')->getClientOriginalExtension();
            //file name to store
            $filenametostore = $filename.'_'.time().'.'.$extension;
            //upload file
            $request->file('upload')->storeAs('public/uploads',$filenametostore);
            $request->file('upload')->storeAs('public/uploads/thumbnail',$filenametostore);
            $thumbnailpath = public_path('storage/uploads/thumbnail/'.$filenametostore);
            $img = Image::make($thumbnailpath)->resize(500,150,function($constraint){
                $constraint->aspectRatio();
            });
            $img->save($thumbnailpath);
            echo json_encode([
                'default'=>asset('storage/uploads/'.$filenametostore),
                '500'=>asset('storage/uploads/thumbnail/'.$filenametostore)
            ]);

        }

    }
}
