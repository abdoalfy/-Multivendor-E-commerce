@extends('layouts.dashbord')
@section('title',$category->name)
@section('nav')
    @parent
    <li class="breadcrumb-item">/ Categories</li>
@endsection
@section('content')
@section('')
  active
@endsection
<div class="container">
<x-alert />
</div>
<table class="table table-striped table-bordered text-center">
  <tr>
    <th>Name</th>
    <th>store</th>
    <th>Status</th>
    <th>Created At</th>
  </tr>
  @if($category->count())
  @foreach($category->products as $product)
  <tr>
      <td>{{  $product->name }}</td>
      <td>{{  $product->store->name }}</td>
      <td>{{  $product->stats }}</td>
      <td>{{  $product->created_at->diffForHumans() }}</td>
  </tr>
  @endforeach
  @else   
  <tr>
    <td colspan="5" class=" alert-danger">No Categories Defined </td>
  </tr>
@endif
</table>
@endsection