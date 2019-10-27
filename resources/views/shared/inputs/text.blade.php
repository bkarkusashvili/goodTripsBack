<div class="form-group col-{{isset($input['size']) ? $input['size'] : '12'}}">
    <label>{{$input['title']}}</label>
    <input 
        type="{{$input['type']}}" 
        name="{{$input['name']}}" 
        {{isset($input['disabled']) && $input['disabled'] ? 'disabled' : '' }}
        class="form-control{{$errors->has($input['name']) ? ' is-invalid':''}}"
        value="{{isset($input['value']) ? $input['value'] : old($input['name'])}}" 
        placeholder="{{$input['title']}}"
    >
    @if ($errors->has($input['name']))
        <div class="invalid-feedback">{{ $errors->first($input['name']) }}</div>        
    @endif
</div>
