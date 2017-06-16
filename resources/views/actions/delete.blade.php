<form role="form" method="POST" action="{{ $action }}" style="display: inline-block">

    {{ csrf_field() }}

    {{ method_field('DELETE') }}

    <button type="submit" class="btn btn-xs btn-danger"
            aria-label="{{$tip or 'Delete'}}"
            data-toggle="tooltip"
            data-placement="auto bottom"
            title="{{$tip or 'Delete'}}">
        <i class="fa fa-trash-o" aria-hidden="true"></i>
    </button>

</form>
