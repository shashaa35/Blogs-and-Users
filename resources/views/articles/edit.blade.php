@extends('app')

@section('content')

  <h1>Edit :{!! $article->title!!}</h1>
  <hr/>
  <!-- form binding :open form with predefined values -->
  <!-- NOTE:patch request is used instead of get or post -->
  <!-- inplace of action,url and route can also be used   -->
    {!!Form::model($article,array('method'=>'PATCH','action'=>['ArticlesController@update',$article->id], 'class'=>'form' ))!!}
    @include('articles._form',['submitButtonText'=>'Update Article'])
   
    @include('errors.list')
@stop 