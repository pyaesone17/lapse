@extends("lapse::app")

@section('content')
<style>
    .container-table100{
        background: #c4d3f6
    }
</style>
<div class="wrap-table">
    <div class="table" style="border-radius: 0">
        <div>
        <h3>{{ $lapse->title }}</h3> 
        <br/>
        <h6>Class : <span style="color: #666666"> {{ $lapse->class }}</span> </h6>
        <br/>
        <h6>Url : <span style="color: #666666"> {{ $lapse->url }} </span> </h6>
        <br/>
        <h6>Method : <span style="color: #666666"> {{ $lapse->method }} </span> </h6>
        <br/>
        <h6>Payload : <span style="color: #666666"> {{ $lapse->payload }} </span> </h6>
        <br/>
        <h6>Time : <span style="color: #666666"> {{ $lapse->created_at->format("D M Y h:i:s") }} </span> </h6>
        <br/>
        <p style="font-size: 14px; color: #7ec699; background: #292C33; padding: 20px; border-radius: 10px">{{ $lapse->content }}</p>
        </div>
        <br/>
        <form method="post" action="{{ route('lapse.destroy',$lapse->id) }}">
            {!! csrf_field() !!}
            {!! method_field('DELETE') !!}
            <button type="submit" class="btn btn-dark btn-lg btn-block">
                Delete
            </button>
        </form>
    </div>
</div>
@endsection