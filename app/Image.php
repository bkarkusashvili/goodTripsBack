<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = [ 'url' ];

    static public function upload($image)
    {
        $imageDB = Image::create(['url' => '']);

        $imageName = time().$imageDB->id.'.'.$image->getClientOriginalExtension();
        $image->move(public_path('upload'), $imageName);
        
        $imageDB->update(['url' => $imageName]);

        return $imageDB;
    }

    static public function remove($id)
    {
        $image = Image::findOrFail($id);

        $path = public_path('upload/'.$image->url);
        
        if(\File::exists($path)) {

            \File::delete($path);
            
            return Image::destroy($id);
        }

        return null;
    }

    static public function replace($id, $image)
    {
        return Image::remove($id) ? Image::upload($image) : null;
    }
}
