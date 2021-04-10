@extends('back.layouts.master')
@section('title','Categories')
@section('content')

<div class="row">
    <div class="col-md-4">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Create new Category</h6>
        </div>
        <div class="card-body">
        <form action="{{route('admin.categories.create')}}" method="POST">
            @csrf
                <div class="form-group"></div>
                <label>Category Name</label>
                <input type="text" class="form-control" name="category" required>
                <button type="submit" class="btn btn-primary btn-block">Add</button>
            </form>
        </div>
    </div>
    </div>
    <div class="col-md-8">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Categories</h6>
            </div>
            <div class="card-body">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Category Name</th>
                                    <th>Article Count</th>
                                    <th>İşlemler</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($categories as $category)
                                <tr>
                                <td>{{$category->name}}</td>
                                <td>{{$category->articleCount()}}</td>
                                    <td>
                                    <a category-id="{{$category->id}}" class="btn btn-warning edit-click"><i class="fa fa-eye">Edit</i></a>
                                    <a post-id="{{$post->id}}" class="btn btn-sm btn-primary edit-click"><i clas="fa fa-edit ">Edit</i></a>
                                    </td>
                                </tr>

                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal" tabindex="-1" id="editModal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Edit Category</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <form action="{{route('admin.categories.update')}}" method="POST">
            @csrf
              <div class="form-group">
                  <label >Category Name:</label>
                  <input id="category" type="text" class="form-control" name="category"/>
                  <input id="category_id" type="hidden" class="form-control" name="id"/>
              </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
        </form>
      </div>
    </div>
  </div>

@endsection
@section('js')
<script>
    $(function(){
        $('.edit-click').click(function(){
            id=$(this)[0].getAttribute('category-id');
            $.ajax({
                type:'get',
                url:'{{route('admin.categories.edit')}}',
                data:{id:id},
                success:function(data){
                    console.log(data);
                    $('#category').val(data.name);
                    $('#category_id').val(data.id);
                    $('#editModal').modal();
                }
            });
        });
    })
</script>

<script>
    $(function(){
        $('.edit-click').click(function(){
            id=$(this)[0].getAttribute('post-id');
            $.ajax({
                type:'get',
                url:'{{route('editpost')}}',
                data:{id:id},
                success:function(data){
                    console.log(data);
                    $('#postTitle').val(data.title);
                    $('#postContent').val(data.content);
                    $('#postId').val(data.id);
                    $('#editModal').modal();
                }
            });
        });
    })
</script>

@endsection

