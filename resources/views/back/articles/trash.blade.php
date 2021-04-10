@extends('back.layouts.master')
@section('title','Trash')
@section('content')

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">{{$articles->count()}} Articles have found</h6>
    <a href="{{route('admin.articles.index')}}" class="btn btn-primary btn-sm float-right">Online articles</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Article Title</th>
                        <th>Category</th>
                        <th>Created_at</th>
                        <th>İşlemler</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($articles as $article)
                    <tr>
                    <td><img src=" {{asset($article->image)}}" width="100"></td>
                        <td>{{$article->title}}</td>
                    <td>{{$article->getCategory->name}}</td>
                    <td>{{$article->created_at->diffForHumans()}}</td>
                        <td>

                        <a href="{{route('admin.article.takeback',$article->id)}}" class="btn btn-outline-primary"><i class="fa fa-recycle"> Take Back</i></a>
                        <a href="{{route('admin.article.delete.trash',$article->id)}}" class="btn btn-outline-danger"><i class="fa fa-trash"> Delete</i></a>

                        </td>
                    </tr>

                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
