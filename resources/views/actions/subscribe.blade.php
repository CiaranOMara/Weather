<form role="form" method="POST" action="{{ $action }}" style="display: inline-block">

    @csrf

    <input type="hidden" name="user" value="{{Auth::user()->id}}">

    <button type="submit" class="btn btn-sm btn-secondary"
            aria-label="{{$tip ?? 'Subscribe'}}"
            data-toggle="tooltip"
            data-placement="auto"
            title="{{$tip ?? 'Subscribe'}}">
        <i class="fa fa-plus-circle" aria-hidden="true"></i>
    </button>

</form>