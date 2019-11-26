<form role="form" method="POST" action="{{ $action }}" style="display: inline-block">

    @csrf

    {{ method_field('DELETE') }}

    <button type="submit" class="btn btn-sm btn-secondary"
            aria-label="{{$tip ?? 'Un-subscribe'}}"
            data-toggle="tooltip"
            data-placement="auto"
            title="{{$tip ?? 'Un-subscribe'}}">
        <i class="fa fa-minus-circle" aria-hidden="true"></i>
    </button>

</form>
