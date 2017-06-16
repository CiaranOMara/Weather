{{-- observing --}}
<div class="form-group{{ $errors->has('observing') ? ' has-error' : '' }}">
    <label for="observing" class="col-md-4 control-label">Observing</label>

    <div class="col-md-6">

        <select class="form-control" name="observing">
            @foreach (\App\Trigger::$models as $key => $label)
                <option value="{{$key}}"
                        @if((isset($observing) && $observing === $key ) or old('observing') === $key)selected="selected"@endif
                >
                    {{$label}}
                </option>
            @endforeach
        </select>
        @if ($errors->has('observing'))
            <span class="help-block">
                <strong>{{ $errors->first('observing') }}</strong>
            </span>
        @endif
    </div>
</div>


{{-- condition --}}
<div class="form-group{{ $errors->has('condition') ? ' has-error' : '' }}">
    <label for="condition" class="col-md-4 control-label">Trigger Condition</label>

    <div class="col-md-6">

        <select class="form-control" name="condition">

            @foreach (\App\Trigger::$conditions as $key => $label)
                <option value="{{$key}}"
                        @if((isset($condition) && $condition === $key ) or old('condition') === $key)selected="selected"@endif
                >
                    {{$label}}
                </option>
            @endforeach

        </select>

        @if ($errors->has('condition'))
            <span class="help-block">
                <strong>{{ $errors->first('condition') }}</strong>
            </span>
        @endif
    </div>
</div>


{{-- value --}}
<div class="form-group{{ $errors->has('value') ? ' has-error' : '' }}">
    <label for="value" class="col-md-4 control-label">Trigger Value</label>

    <div class="col-md-6">
        <input id="value" type="text" class="form-control" name="value"
               value="{{ $value or old('value') }}">

        @if ($errors->has('value'))
            <span class="help-block">
                <strong>{{ $errors->first('value') }}</strong>
            </span>
        @endif
    </div>
</div>


{{-- description --}}
<div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
    <label for="description" class="col-md-4 control-label">Description</label>

    <div class="col-md-6">
        <input id="description" type="text" class="form-control" name="description"
               value="{{ $description or old('description') }}" autofocus>

        @if ($errors->has('description'))
            <span class="help-block">
                <strong>{{ $errors->first('description') }}</strong>
            </span>
        @endif
    </div>
</div>