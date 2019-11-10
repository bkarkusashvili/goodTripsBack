<div class="form-group col-{{isset($input['size']) ? $input['size'] : '12'}}">
    <label>{{$input['title']}}</label>
    <textarea 
        name="{{$input['name']}}"
        {{isset($input['disabled']) && $input['disabled'] ? 'disabled' : '' }}
        class="form-control{{isset($input['class']) ? ' ' . $input['class']:''}}{{$errors->has($input['name']) ? ' is-invalid':''}}"
        placeholder="{{$input['title']}}"
    >{{isset($input['value']) ? $input['value'] : old($input['name'])}}</textarea>
    @if ($errors->has($input['name']))
        <div class="invalid-feedback">{{ $errors->first($input['name']) }}</div>        
    @endif
</div>
