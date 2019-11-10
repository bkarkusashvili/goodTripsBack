<div class="form-group gallery-image col-{{isset($input['size']) ? $input['size'] : '12'}}">
    <h3>გალერია</h3>
    <div class="custom-file">
        <input 
            multiple
            type="file" 
            name="{{$input['name']}}[]" 
            {{isset($input['disabled']) && $input['disabled'] ? 'disabled' : '' }}
            class="custom-file-input{{$errors->has($input['name']) ? ' is-invalid':''}}"
        >
        <label class="custom-file-label">{{$input['title']}}</label>
        @if ($errors->has($input['name']))
            <div class="invalid-feedback">{{ $errors->first($input['name']) }}</div>        
        @endif
    </div>
    <div class="gallery-image-cont">
        @if (isset($input['value']))
            @foreach ($input['value'] as $item)
                <img src="{{url('upload', $item->url)}}" />                
            @endforeach
        @endif
    </div>
</div>
