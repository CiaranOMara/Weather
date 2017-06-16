<form role="form" method="POST" action="{{ $action }}" style="display: inline-block">

    {{ csrf_field() }}

    <input type="hidden" name="user" value="{{Auth::user()->id}}">

    <button type="submit" class="btn btn-xs btn-default"
            aria-label="{{$tip or 'Subscribe'}}"
            data-toggle="tooltip"
            data-placement="auto bottom"
            title="{{$tip or 'Subscribe'}}">
        <i class="fa fa-plus-circle" aria-hidden="true"></i>
    </button>

</form>