<div class="form-group cover-image col-{{isset($input['size']) ? $input['size'] : '12'}}">
    @if (isset($input['value']->url))
        <img src="{{url('upload', $input['value']->url)}}" />
    @else
        <img />        
    @endif
    <div class="custom-file">
        <input 
            type="{{$input['type']}}" 
            name="{{$input['name']}}" 
            {{isset($input['disabled']) && $input['disabled'] ? 'disabled' : '' }}
            class="custom-file-input{{$errors->has($input['name']) ? ' is-invalid':''}}"
        >
        <label class="custom-file-label">{{$input['title']}}</label>
        @if ($errors->has($input['name']))
            <div class="invalid-feedback">{{ $errors->first($input['name']) }}</div>        
        @endif
    </div>
</div>
