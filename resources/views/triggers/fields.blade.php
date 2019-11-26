{{-- observing --}}
<div class="form-group row">
    <label for="observing" class="col-md-4 col-form-label text-md-right">Observing</label>

    <div class="col-md-6">

        <select class="form-control @error('observing') is-invalid @enderror" name="observing">
            @foreach (\App\Trigger::$models as $key => $label)
                <option value="{{$key}}"
                        @if((isset($observing) && $observing === $key ) ?? old('observing') === $key)selected="selected"@endif
                >
                    {{$label}}
                </option>
            @endforeach
        </select>
        @error('observing')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>


{{-- condition --}}
<div class="form-group row">
    <label for="condition" class="col-md-4 col-form-label text-md-right">Trigger Condition</label>

    <div class="col-md-6">

        <select class="form-control @error('condition') is-invalid @enderror" name="condition">

            @foreach (\App\Trigger::$conditions as $key => $label)
                <option value="{{$key}}"
                        @if((isset($condition) && $condition === $key ) ?? old('condition') === $key)selected="selected"@endif
                >
                    {{$label}}
                </option>
            @endforeach

        </select>

        @error('condition')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>


{{-- value --}}
<div class="form-group row">
    <label for="value" class="col-md-4 col-form-label text-md-right">Trigger Value</label>

    <div class="col-md-6">
        <input id="value" type="text" class="form-control @error('value') is-invalid @enderror" name="value"
               value="{{ $value ?? old('value') }}" autofocus>

        @error('value')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>


{{-- description --}}
<div class="form-group row">
    <label for="description" class="col-md-4 col-form-label text-md-right">Description</label>

    <div class="col-md-6">
        <input id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description"
               value="{{ $description ?? old('description') }}">

        @error('description')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>