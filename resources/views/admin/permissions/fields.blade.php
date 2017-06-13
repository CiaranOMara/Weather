{{-- namme --}}
<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
    <label for="name" class="col-md-4 control-label">Name</label>

    <div class="col-md-6">
        <input id="name" type="text" class="form-control" name="name"
               value="{{ $name or old('name') }}" autofocus>

        @if ($errors->has('name'))
            <span class="help-block">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
        @endif
    </div>
</div>


{{-- slug --}}
<div class="form-group{{ $errors->has('slug') ? ' has-error' : '' }}">
    <label for="slug" class="col-md-4 control-label">Slug</label>

    <div class="col-md-6">
        <input id="slug" type="text" class="form-control" name="slug"
               value="{{ $slug or old('slug') }}">

        @if ($errors->has('slug'))
            <span class="help-block">
                <strong>{{ $errors->first('slug') }}</strong>
            </span>
        @endif
    </div>
</div>


{{-- description --}}
<div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
    <label for="description" class="col-md-4 control-label">Description</label>

    <div class="col-md-6">
        <input id="description" type="text" class="form-control" name="description"
               value="{{ $description or old('description') }}">

        @if ($errors->has('description'))
            <span class="help-block">
                <strong>{{ $errors->first('description') }}</strong>
            </span>
        @endif
    </div>
</div>

{{-- model --}}
<div class="form-group{{ $errors->has('model') ? ' has-error' : '' }}">
    <label for="model" class="col-md-4 control-label">Model</label>

    <div class="col-md-6">
        <input id="model" type="text" class="form-control" name="model"
               value="{{ $model or old('model') }}">

        @if ($errors->has('model'))
            <span class="help-block">
                <strong>{{ $errors->first('model') }}</strong>
            </span>
        @endif
    </div>
</div>
