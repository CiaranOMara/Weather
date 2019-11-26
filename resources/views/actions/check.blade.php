<form role="form" method="POST" action="{{ $action }}" style="display: inline-block">

    @csrf

    {{ method_field('PATCH') }}

    <button type="submit" class="btn btn-sm btn-secondary"
            aria-label="{{$tip ?? 'Check'}}"
            data-toggle="tooltip"
            data-placement="auto"
            title="{{$tip ?? 'Check'}}">
        <i class="fa fa-check" aria-hidden="true"></i>
    </button>

</form>
