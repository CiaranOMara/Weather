{{-- namme --}}
<div class="form-group row">
    <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>

    <div class="col-md-6">
        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
               value="{{ $name ?? old('name') }}" autofocus>

        @error('name')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>


{{-- slug --}}
<div class="form-group row">
    <label for="slug" class="col-md-4 col-form-label text-md-right">Slug</label>

    <div class="col-md-6">
        <input id="slug" type="text" class="form-control @error('slug') is-invalid @enderror" name="slug"
               value="{{ $slug ?? old('slug') }}">

        @error('slug')
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

{{-- model --}}
<div class="form-group row">
    <label for="model" class="col-md-4 col-form-label text-md-right">Model</label>

    <div class="col-md-6">
        <input id="model" type="text" class="form-control @error('model') is-invalid @enderror" name="model"
               value="{{ $model ?? old('model') }}">

        @error('model')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>
