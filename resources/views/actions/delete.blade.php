<form role="form" method="POST" action="{{ $action }}" style="display: inline-block">

    @csrf

    {{ method_field('DELETE') }}

    <button type="submit" class="btn btn-sm btn-danger"
            aria-label="{{$tip ?? 'Delete'}}"
            data-toggle="tooltip"
            data-placement="auto"
            title="{{$tip ?? 'Delete'}}">
        <i class="fa fa-trash-o" aria-hidden="true"></i>
    </button>

</form>
