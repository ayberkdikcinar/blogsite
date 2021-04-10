
@extends('front.layouts.master')
@section('title',$articles->title)
@section('bg',$articles->image)

@section('content')
  <!-- Post Content -->

        <div class="col-md-9 mx-auto">
        <h2>{{$articles->title}}</h2>
         {{$articles->content}}
        </div>

 @include('front.widgets.categoryWidget')
  @endsection
