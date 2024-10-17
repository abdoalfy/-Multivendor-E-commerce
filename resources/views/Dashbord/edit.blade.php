@extends('layouts.dashbord')
@section('title')
Edit Category
@endsection
@section('nav')
    @parent
    <li class="breadcrumb-item "> / Categories</li>
    <li class="breadcrumb-item ">Edit Category</li>
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
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- jquery validation -->
            <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">Edit Category <small>/ Categories</small></h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post" action="{{ route('categories.update' , $category->id) }}" id="quickForm" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Category Name</label>
                        <x-forminput name="name" type="text" value="{{ $category->name}}"/>
                      </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Parent</label>
                <select  name="parent_id" class="form-control form-select ">
                    <option value="">{{ $category->name }}</option>
                    @foreach ($parents as $parent)
                        <option value="{{ $parent->id }}" @selected($category->parent_id == $parent->id)>{{ $parent->name }}</option>
                    @endforeach
                </select>

                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Discription</label>
                    <x-forminput name="description" type="textarea" value="{{$category->description }}"   />
                 
                  </div>

                  <div class="form-group">
                    <label  for="exampleInputPassword1">Category Image</label>
                    <input value="{{ $category->cat_img }}" name="cat_img" type="file" class="form-control" placeholder="category Image">
                    @if($category->cat_img)
                      <img src="{{$category->cat_img}}" class=" mt-3" style="margin-left: 600px" height="100px">
                    @endif
                  </div>
<div  class="form-group">
    <label style="font-size: 22px" for="">Status</label>
    <div class="custom-control custom-radio">
        <input class="custom-control-input custom-control-input-success" type="radio" name="status" id="exampleRadios1" value="active" @checked($category->status == 'active') >
        <label class="custom-control-label" for="exampleRadios1">
         Active
        </label>
      </div>
      <div class="custom-control custom-radio">
        <input class="custom-control-input custom-control-input-success" type="radio" name="status" id="exampleRadios2" value="inactive"  @checked($category->status == 'inactive')>
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
                  <button type="submit" class="btn btn-success">Update</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
            </div>
        </div>
      </div>
@endsection