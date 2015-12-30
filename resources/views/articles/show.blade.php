@extends('app')
@section('content')
        <h1>{{$articles->title}}</h1>
<article>
        <h2>{{$articles->body}}</h2>
</article>
@stop
