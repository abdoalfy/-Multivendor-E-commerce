@extends('layouts.dashbord')
@section('title')
Edit Products
@endsection
@section('nav')
    @parent
    <li class="breadcrumb-item "> / Products</li>
    <li class="breadcrumb-item ">Edit Product</li>
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
                <h3 class="card-title">Edit Product <small>/ Products</small></h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post" action="{{ route('products.update',$prod->id) }}"  id="quickForm" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Product Name</label>
                        <x-forminput name="name" type="text" value="{{$prod->name}}"/>
                      </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Parent</label>
                <select  name="parent_id" class="form-control form-select ">
                    <option value=""> Primary Category</option>
                    @foreach ( App\Models\Category::all() as $category)
                        <option value="{{ $category->id }}" @selected($prod->cat_id == $category->id)>{{ $category->name }}</option>
                    @endforeach
                </select>
                  </div>


                  <div class="form-group">
                    <label for="exampleInputPassword1">Discription</label>
                    <x-forminput name="description" type="textarea" value="{{$prod->description }}"   />
                  </div>

                  <div class="form-group">
                    <label for="exampleInputPassword1">Price</label>
                    <x-forminput name="price" type="text" value="{{$prod->price }}"   />
                  </div>

                  <div class="form-group">
                    <label for="exampleInputPassword1">Compare Price</label>
                    <x-forminput name="compare_price" type="textarea" value="{{$prod->compare_price }}"   />
                  </div>

                  <div class="form-group">
                    <label  for="exampleInputPassword1">Product Image</label>
                    <input value="{{ $prod->pro_img }}" name="pro_img" type="file" class="form-control" placeholder="Product Image">
                    @if($prod->pro_img)
                      <img src="{{$prod->pro_img}}" class=" mt-3" style="margin-left: 600px" height="100px">
                    @endif
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">tags</label>
                    <x-forminput name="tags" type="text"  value="{{ $tags }}"/>
                  </div>

<div  class="form-group">
    <label style="font-size: 22px" for="">Status</label>
    <div class="custom-control custom-radio">
        <input class="custom-control-input custom-control-input-success" type="radio" name="stats" id="exampleRadios1" value="active" @checked($prod->stats == 'active') >
        <label class="custom-control-label" for="exampleRadios1">
         Active
        </label>
      </div>
      <div class="custom-control custom-radio">
        <input class="custom-control-input custom-control-input-success" type="radio" name="stats" id="exampleRadios2" value="inactive"  @checked($prod->stats == 'inactive')>
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