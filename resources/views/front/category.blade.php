
@extends('front.layouts.master')
@section('title',$category->name.' Kategorisi |  '.count($articles).' yazı bulundu')
@section('content')
  <!-- Main Content -->
    @if (count($articles)>0)
      <div class="col-md-9 mx-auto">
        @foreach ($articles as $article)
        <div class="post-preview">
          <a href="{{route('single',[$article->getCategory->slug,$article->slug])}}">
              <h2 class="post-title">
                {{$article->title}}
              </h2>
              <h3 class="post-subtitle">
                {{Str::limit($article->content,90)}}
              </h3>
            </a>
            <p class="post-meta"> Kategori:
              <a href="#">{{$article->getCategory->name}}</a>
            <span class="float-right"> {{$article->created_at->diffForHumans()}}</span></p>
          </div>

          @if (!$loop->last)
          <hr>
          @endif
         @endforeach
         {{$articles->links()}}
    @else
     <div class="alert alert-danger">
         <h1>Bu Kategoriye ait yazı bulunamadı...</h1>
        </div>
    @endif
      </div>
@include('front.widgets.categoryWidget')
@endsection

