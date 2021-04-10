@extends('back.layouts.master')
@section('content')

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary"></h6>
    </div>

    <div class="card-body">
        @if ($errors->any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                <li>{{$error}}</li>
                @endforeach
            </div>
        @endif
    <form action="{{route('admin.articles.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <p>Article title</p>
            <input type="text" name="title" class="form-control" required>
        </div>
        <div class="form-group">
            <p>Article Category</p>
           <select name="categories" class="form-control" required>
               <option value="">Choose</option>
               @foreach ($categories as $category)
           <option value="{{$category->id}}">{{$category->name}}</option>
               @endforeach
            </select>
        </div>
        <div class="form-group">
            <p>Article image</p>
           <input type="file" name="image" class="form-control" required>
        </div>
        <div class="form-group">
            <p>Article content</p>
           <textarea id="summernote"name="content" rows="10" class="form-control" required></textarea>
        </div>
        <div class="form-group">
           <button type="submit" name="image" class="btn btn-primary btn-block" required>Create</button>
        </div>
    </form>
    </div>

</div>

@endsection
@section('css')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
@endsection
@section('js')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script>
    $(document).ready(function() {
        $('#summernote').summernote(
        {'height':300}
        );
    });
  </script>

@endsection
