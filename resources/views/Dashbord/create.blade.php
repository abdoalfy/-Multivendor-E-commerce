@extends('layouts.dashbord')
@section('title')
Add New Category
@endsection
@section('content')
<section class="content">
      <div class="container-fluid">
        @if ($errors->any()) 
<div class="alert alert-danger"> 
    <ul> 
       @foreach ($errors->all() as $error) 
         <li>{{ $error }}</li> 
       @endforeach 
  </ul> 
</div> 
@endif
@section('create')
  active
@endsection
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- jquery validation -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Add new Category <small>/ Categories</small></h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post" action="{{ route('categories.store') }}" id="quickForm" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Category Name</label>
                        <input type="text" value="{{ old('name') }}" name="name" class="form-control @error('name') is-invalid @enderror" id="exampleInputEmail1" placeholder="Enter Category Name">
                        @error('name')
                          <div class="text-danger">
                           {{ $message }}
                          </div>
                        @enderror
                      </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Parent</label>
                <select name="parent_id" class="form-control form-select ">
                    <option value="">Primary Category</option>
                    @foreach ($parents as $parent)
                        <option value="{{ $parent->id }}">{{ $parent->name }}</option>
                    @endforeach
                </select>

                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Discription</label>
                    <textarea name="description" style="height:100px" class="form-control"  placeholder="category description"> {{ old('description') }}</textarea>
                  </div>

                  <div class="form-group">
                    <label  for="exampleInputPassword1">Category Image</label>
                    <input name="cat_img" type="file" class="form-control"  placeholder="category Image">
                  </div>
<div  class="form-group">
    <label for="">Status</label>
    <div class="custom-control custom-radio">
        <input class="custom-control-input custom-control-input-primary" type="radio" name="status" id="exampleRadios1" value="active" checked>
        <label class="custom-control-label" for="exampleRadios1">
         Active
        </label>
      </div>
      <div class="custom-control custom-radio">
        <input class="custom-control-input custom-control-input-primary" type="radio" name="status" id="exampleRadios2" value="inactive">
        <label class="custom-control-label" for="exampleRadios2">
          Inactive
        </label>
      </div>
</div>
               <hr> 

                  <div class="form-group mb-0">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" name="terms" class="custom-control-input" id="exampleCheck1">
                      <label class="custom-control-label" for="exampleCheck1">I agree to the <a href="#">terms of service</a>.</label>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
            </div>
        </div>
      </div>
@endsection