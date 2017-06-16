<form role="form" method="POST" action="{{ $action }}" style="display: inline-block">

    {{ csrf_field() }}

    {{ method_field('DELETE') }}

    <button type="submit" class="btn btn-xs btn-default"
            aria-label="{{$tip or 'Un-subscribe'}}"
            data-toggle="tooltip"
            data-placement="auto bottom"
            title="{{$tip or 'Un-subscribe'}}">
        <i class="fa fa-minus-circle" aria-hidden="true"></i>
    </button>

</form>
