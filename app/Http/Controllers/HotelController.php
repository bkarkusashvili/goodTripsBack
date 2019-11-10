<?php

namespace App\Http\Controllers;

use App\Image;
use App\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\AdminController;

class HotelController extends AdminController
{
    protected $model = 'App\Hotel';

    protected $select = ['id', 'title_ka', 'title_en', 'address_ka', 'address_en', 'description_ka', 'description_en', 'author_ka', 'author_en', 'services', 'website', 'email', 'mobile', 'location', 'gallery', 'image_id'];

    protected $modelName = 'hotel';

    protected $title = 'Hotels';

    protected $mainInputs = [
        [ 'name' => 'title_ka', 'type' => 'text', 'title' => 'სათაური (ქარ.)', 'size' => 6 ],
        [ 'name' => 'title_en', 'type' => 'text', 'title' => 'სათაური (ინგ.)', 'size' => 6 ],
        [ 'name' => 'address_ka', 'type' => 'text', 'title' => 'მისამართი (ქარ.)', 'size' => 6 ],
        [ 'name' => 'address_en', 'type' => 'text', 'title' => 'მისამართი (ინგ.)', 'size' => 6 ],
        [ 'name' => 'author_ka', 'type' => 'text', 'title' => 'ავტორი (ქარ.)', 'size' => 6 ],
        [ 'name' => 'author_en', 'type' => 'text', 'title' => 'ავტორი (ინგ.)', 'size' => 6 ],
        [ 'name' => 'description_ka', 'type' => 'textarea', 'title' => 'აღწერა (ქარ.)', 'class' => 'description tinymce' ],
        [ 'name' => 'description_en', 'type' => 'textarea', 'title' => 'აღწერა (ინგ.)', 'class' => 'description tinymce' ],
        [ 'name' => 'gallery', 'type' => 'gallery', 'title' => 'სურათების არჩევა' ],
        [ 'name' => 'location', 'type' => 'map', 'title' => 'რუკა' ],
    ];

    protected $asideInputs = [
        [ 'name' => 'services', 'type' => 'select', 'title' => 'სერვისები', 'multiple' => true ],
        [ 'name' => 'website', 'type' => 'text', 'title' => 'საიტი' ],
        [ 'name' => 'email', 'type' => 'text', 'title' => 'მეილი' ],
        [ 'name' => 'mobile', 'type' => 'text', 'title' => 'მობილური' ],
        [ 'name' => 'image', 'type' => 'file', 'title' => 'მთავარი სურათი' ],
    ];

    protected $headers = [
        'id' => 'ID',
        'image' => 'სურათი',
        'title_ka' => 'სახელი (ქარ.)',
        'title_en' => 'სახელი (ინგ.)',
    ];

    protected $createValidators = [
        'title_ka' => 'required|string|max:255',
        'title_en' => 'required|string|max:255',
        'address_ka' => 'required|string',
        'address_en' => 'required|string',
        'author_ka' => 'string',
        'author_en' => 'string',
        'description_ka' => 'required|string',
        'description_en' => 'required|string',
        'services' => 'nullable|array',
        'services.*' => 'numeric',
        'website' => 'nullable|url|string',
        'email' => 'nullable|email|string',
        'mobile' => 'nullable|string',
        'gallery' => 'nullable|array',
        'gallery.*' => 'image',
        'location' => 'nullable|string',
        'image' => 'required|image',
    ];

    protected $updateValidators = [
        'title_ka' => 'required|string|max:255',
        'title_en' => 'required|string|max:255',
        'address_ka' => 'required|string',
        'address_en' => 'required|string',
        'author_ka' => 'string',
        'author_en' => 'string',
        'description_ka' => 'required|string',
        'description_en' => 'required|string',
        'services' => 'nullable|array',
        'services.*' => 'numeric',
        'website' => 'nullable|url|string',
        'email' => 'nullable|email|string',
        'mobile' => 'nullable|string',
        'gallery' => 'nullable|array',
        'gallery.*' => 'image',
        'location' => 'nullable|string',
        'image' => 'nullable|image',
    ];

    public function __construct() {
        $this->asideInputs[0]['options'] = [
            ['value' => '', 'title' => ''],
            Service::select('id as value', 'title_ka as title')->get()
        ];
    }

    public function beforeStore($data)
    {   
        if (isset($data['gallery'])) {
            $gallery = [];
            foreach ($data['gallery'] as $image) {
                $gallery[] = Image::upload($image)->id;
            }
            $data['gallery'] = json_encode($gallery);
        }

        $data['image_id'] = Image::upload($data['image'])->id;
        unset($data['image']);

        return $data;
    }

    public function beforeUpdate($data)
    {
        if (isset($data['image'])) {
            $data['image_id'] = Image::replace($this->model->image->id, $data['image'])->id;
            unset($data['image']);
        }
        
        if (isset($data['gallery'])) {
            $gallery = json_decode($this->model->gallery);
            foreach ($data['gallery'] as $image) {
                $gallery[] = Image::upload($image)->id;
            }
            $data['gallery'] = json_encode($gallery);
        }

        return $data;   
    }

    public function beforeDestroy($data)
    {
        $status = true;
        $status = Image::remove($data->image->id);

        foreach (json_decode($data->gallery) as $image) {
            $status = Image::remove($image);
        }

        return true;
    }
}
