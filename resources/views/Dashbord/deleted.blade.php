@extends('layouts.dashbord')
@section('title','categories')
@section('nav')
    @parent
    <li class="breadcrumb-item">/ Categories</li>
@endsection
@section('content')
@section('trashed')
  active
@endsection
<div class="container">
<x-alert />
</div>
<form method="get" action="{{ route('trash')}}" class="d-flex justify-content-between" style="margin-bottom: 20px">
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
    <th>Category Discription</th>
    <th>Image</th>
    <th>Status</th>
    <th>deleted At</th>
    <th colspan="2">Operations</th>
  </tr>
  @if($categories->count())
  @foreach ($categories as $category)
  <tr>
      <td>{{ $category->id }}</td>
      <td>{{ $category->name }}</td>
      <td>{{ $category->description }}</td>
      <td><img src="{{asset('storage/'.$category->cat_img)  }}" height="80"></td> 
      <td>{{ $category->status }}</td>
      <td>{{ $category->deleted_at->diffForHumans() }}</td>
      <td>
<a href="{{ route('restore',$category->id) }}" class=" btn btn-warning">Restore</a>
      </td>
      <td>
      <form method="post" action="{{ route('forceDelete' ,$category->id) }}">
        @method('DELETE')
      @csrf 
      <button type="submit" style="color:black" class="btn btn-danger">Delete</button>
      </form>
            </td>
  </tr>
  @endforeach
  @else   
  <tr>
    <td colspan="8" class=" alert-danger">No Categories Defined </td>
  </tr>
@endif
</table>
@endsection