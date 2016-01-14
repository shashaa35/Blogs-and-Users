@extends('app')

@section('content')

  <h1>Create Article</h1>
  <hr/>
    
    {!!Form::model($article=new \App\Article,array('url'=>'articles', 'class'=>'form' ))!!}
   @include('articles._form',['submitButtonText'=>'Add Article'])
    @include('errors.list')
@stop 