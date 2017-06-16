<form role="form" method="POST" action="{{ $action }}" style="display: inline-block">

    {{ csrf_field() }}

    {{ method_field('PATCH') }}

    <button type="submit" class="btn btn-xs btn-default"
            aria-label="{{$tip or 'Check'}}"
            data-toggle="tooltip"
            data-placement="auto bottom"
            title="{{$tip or 'Check'}}">
        <i class="fa fa-check" aria-hidden="true"></i>
    </button>

</form>
