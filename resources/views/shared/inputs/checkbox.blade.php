<div class="form-group col-{{isset($input['size']) ? $input['size'] : '12'}}">
    <div class="custom-control custom-checkbox">
        <input 
            type="checkbox"
            {{isset($input['disabled']) && $input['disabled'] ? 'disabled' : '' }} 
            name="{{$input['name']}}" 
            class="custom-control-input{{$errors->has($input['name']) ? ' is-invalid':''}}" 
            {{(isset($input['value']) && $input['value']) || old($input['name']) ? 'checked' : ''}}
            id="{{$input['name']}}"
        >
        <label class="custom-control-label" for="{{$input['name']}}">{{$input['title']}}</label>
        @if ($errors->has($input['name']))
            <div class="invalid-feedback">{{ $errors->first($input['name']) }}</div>        
        @endif
    </div>
</div>
