@extends('app')

@section('content')

  <h1>Create Article</h1>
  <hr/>
    
    {!!Form::open(array('url'=>'articles', 'class'=>'form' ))!!}
   @include('articles._form',['submitButtonText'=>'Add Article'])
    @include('errors.list')
@stop 