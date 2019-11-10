<div class="form-group col-{{isset($input['size']) ? $input['size'] : '12'}}">
    <label>{{$input['title']}}</label>
    <select 
        {{isset($input['multiple']) && $input['multiple'] ? 'multiple':'' }}
        name="{{isset($input['multiple']) && $input['multiple'] ? $input['name'].'[]':$input['name']}}" 
        class="custom-select{{$errors->has($input['name']) ? ' is-invalid':''}}"
        {{isset($input['disabled']) && $input['disabled'] ? 'disabled' : '' }}
    >
        <option value="{{$input['options'][0]['value']}}">{{$input['options'][0]['title']}}</option>
        @foreach ($input['options'][1] as $item)
            <option 
                value="{{$item->value}}"
                {{
                    (isset($input['value']) && 
                        ($input['value'] == $item->value || in_array($item->value, $input['value']))) || 
                    (!isset($input['value']) && 
                        (old($input['name']) == $item->value || in_array($item->value, is_array(old($input['name'])) ? old($input['name']) : []))) ? 'selected':''
                }}
            >{{$item->title}}</option>
        @endforeach
    </select>
    @if ($errors->has($input['name']))
        <div class="invalid-feedback">{{ $errors->first($input['name']) }}</div>        
    @endif
</div>
