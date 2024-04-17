<h1>{{$task->title}}</h1>
<h1>{{$task->description}}</h1>

@if($task->long_description)
    <p>{{$task->long_description}}</p>
@endif

<p>{{$task->created_at}}</p>
<p>{{$task->updated_at}}</p>
