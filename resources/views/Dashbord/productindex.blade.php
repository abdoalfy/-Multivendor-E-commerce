@extends('layouts.dashbord')
@section('title','Products')
@section('nav')
    @parent
    <li class="breadcrumb-item">/ Products</li>
@endsection
@section('content')
@section('products')
  active
@endsection
<div class="container">
<x-alert />
</div>
<form method="get" action="{{ route('products.index')}}" class="d-flex justify-content-between" style="margin-bottom: 20px">
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
    <th>Category</th>
    <th>Store</th>
    <th>Product Discription</th>
    <th>Image</th>
    <th>Status</th>
    <th>Created At</th>
    <th colspan="2">Operations</th>
  </tr>
  @if($products->count())
  @foreach ($products as $product)
  <tr>
      <td>{{ $product->id }}</td>
      <td>{{ $product->name }}</td>
      <td>{{ $product->category->name }}</td>
      <td>{{ $product->store->name }}</td>
      <td>{{ $product->description }}</td>
      <td><img src="{{asset($product->pro_img)  }}" height="80"></td> 
      <td>{{ $product->stats }}</td>
      <td>{{ $product->created_at->diffForHumans() }}</td>
      <td>
<a href="{{ route('products.edit',$product->id) }}" class=" btn btn-warning">Edit</a>
      </td>
      <td>
      <form method="post" action="{{ route('categories.destroy',$product->id) }}">
        @method('DELETE')
      @csrf 
      <button type="submit" style="color:black" class="btn btn-danger">Delete</button>
      </form>
            </td>
  </tr>
  @endforeach
  @else   
  <tr>
    <td colspan="9" class=" alert-danger">No Prodcuts Defined </td>
  </tr>
@endif
</table>
<div>{{ $products->withQueryString()->links() }}</div>
<a style="margin-left: 652px; margin-top:-60px;"   href="{{ route('categories.create') }}" class="btn btn-primary">Add new product</a>
@endsection