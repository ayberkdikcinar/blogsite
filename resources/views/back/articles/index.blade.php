@extends('back.layouts.master')
@section('content')

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">{{$articles->count()}} Articles have found</h6>
    <a href="{{route('admin.article.trash')}}" class="float-right btn btn-warning btn-sm" style="color: black"><i class="fa fa-trash">Trash</i></a>
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
                            <a href="{{route('single',[$article->getCategory->slug,$article->slug])}}" target="_blank" class="btn btn-outline-success"><i class="fa fa-eye"> Show</i></a>
                        <a href="{{route('admin.articles.edit',$article->id)}}" class="btn btn-outline-warning"><i class="fa fa-edit"> Edit</i></a>

                        <a href="{{route('admin.article.delete',$article->id)}}" class="btn btn-outline-danger"><i class="fa fa-trash"> Delete</i></a>

                        </td>
                    </tr>

                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
