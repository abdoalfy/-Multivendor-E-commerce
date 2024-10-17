@extends('layouts.dashbord')
@section('title','categories')
@section('nav')
    @parent
    <li class="breadcrumb-item">/ Categories</li>
@endsection
@section('content')
@section('index')
  active
@endsection
<div class="container">
<x-alert />
</div>
<form method="get" action="{{ route('categories.index')}}" class="d-flex justify-content-between" style="margin-bottom: 20px">
<input type="search" name="name" value="{{request('name')}}" class="form-control mx-2">
<select name="status" class="form-control mx-2">
  <option value="">All</option>
  <option value="active" @selected(request('status')=='active')>Active</option>
  <option value="inactive" @selected(request('status')=='inactive')>Inactive</option>
</select>
<button class="btn btn-dark mx-2">Search</button>
</form>
<table class="table table-striped table-bordered text-center">
  <tr>
    <th>ID</th>
    <th>Name</th>
    <th>Parent</th>
    <th># products</th>
    <th>Category Discription</th>
    <th>Image</th>
    <th>Status</th>
    <th>Created At</th>
    <th colspan="2">Operations</th>
  </tr>
  @if($categories->count())

  @foreach ($categories as $category)
  <tr>
      <td>{{ $category->id }}</td>
      <td> <a href="{{ route('categories.show',$category->id) }}">{{ $category->name }}</a></td>
      <td>{{ $category->parent->name  }}</td>
      <td>{{ $category->products_count }}</td>
      <td>{{ $category->description }}</td>
      <td><img src="{{asset($category->cat_img)  }}" height="80"></td> 
      <td>{{ $category->status }}</td>
      <td>{{ $category->created_at->diffForHumans() }}</td>
      <td>
<a href="{{ route('categories.edit',$category->id) }}" class=" btn btn-warning">Edit</a>
      </td>
      @if(Auth::user()->can('categories.delete'))
      <td>
        <form method="post" action="{{ route('categories.destroy',$category->id) }}">
          @method('DELETE')
        @csrf 
        <button type="submit" style="color:black" class="btn btn-danger">Delete</button>
        </form>
              </td>    
      @endif
  </tr>
  @endforeach
  @else   
  <tr>
    <td colspan="9" class=" alert-danger">No Categories Defined </td>
  </tr>
@endif
</table>
<div style="margin-left: 1290px">{{ $categories->withQueryString()->links() }}</div>
<a style="margin-left: 652px; margin-top:-20px;"   href="{{ route('categories.create') }}" class="btn btn-primary">Add new category</a>
@endsection