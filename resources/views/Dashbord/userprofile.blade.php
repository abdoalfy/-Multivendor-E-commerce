@extends('layouts.dashbord')
@section('title')
Edit Your Profile
@endsection
@section('nav')
    @parent
    <li class="breadcrumb-item "> / User</li>
    <li class="breadcrumb-item ">Edit profile</li>
@endsection
@section('content')
<section class="content">
      <div class="container-fluid">
   
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- jquery validation -->
            <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">Edit Profile <small>/ Profile</small></h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post" action="{{ route('profileeupdate') }}" id="quickForm">
                @csrf
                @method('patch')
                <div class="card-body">
                <div class=" form-row">
                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">First Name</label>
                        <x-forminput name="fitrst_name" type="text" value="{{$user->profile->fitrst_name}}"/>
                    </div>
                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1">Last Name</label>
                            <x-forminput name="last_name"  type="text" value="{{$user->profile->last_name}}"/>
                        </div>
                      </div>
                    <div class="form-row">

                         <div  class="form-group col-md-6">
                            <label style="font-size: 22px" for="">Gender</label>
                            <div class="custom-control custom-radio">
                                <input class="custom-control-input custom-control-input-success" type="radio" name="gender" id="exampleRadios1" value="male" @checked($user->profile->gender) >
                                <label class="custom-control-label" for="exampleRadios1">
                                 Male
                                </label>
                              </div>
                              <div class="custom-control custom-radio">
                                <input class="custom-control-input custom-control-input-success" type="radio" name="gender" id="exampleRadios2" value="female"  @checked($user->profile->gender)>
                                <label class="custom-control-label" for="exampleRadios2">
                                  Female
                                </label>
                              </div>
                         </div>
                              <div class="form-group  col-md-6">
                                <label for="exampleInputEmail1">Birthday</label>
                                <x-forminput name="birthday" type="date" value="{{$user->profile->birthday}}"/>
                        </div>
                    </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                              <label for="exampleInputEmail1">Street Location</label>
                              <x-forminput name="street_address" type="text" value="{{$user->profile->street_address}}"/>
                               </div>
                                    <div class="form-group col-md-6">
                                        <label for="exampleInputEmail1">City</label>
                                        <x-forminput name="city" type="text" value="{{$user->profile->city}}"/>
                                    </div>
                                  </div>
                                  <div class="form-row">
                                    <div class="form-group col-md-6">
                                      <label for="exampleInputEmail1">state</label>
                                      <x-forminput name="state" type="text" value="{{$user->profile->state}}"/>
                                    </div>
                                    <div class="form-group  col-md-6">
                                      <label for="exampleInputEmail1">Postal Code</label>
                                      <x-forminput name="postal_code" type="text" value="{{$user->profile->postal_code}}"/>
                                      </div>
                                  </div>
   <div class="form-row">

    <div class="form-group col-md-6">
      <label for="exampleInputEmail1">Country</label>
        <select  name="country" class="form-control form-select ">
          @foreach ($countries as $value => $text )
            <option value="{{ $value }}" @selected($value == $user->profile->country)>{{ $text }}</option>
          @endforeach 
        </select>
      </div>

      <div class="form-group col-md-6">
        <label for="exampleInputEmail1">locale</label>
          <select  name="locale" class="form-control form-select ">
            @foreach ($locales as $value => $text )
              <option value="{{ $value }}" @selected($value == $user->profile->locale)>{{ $text }}</option>
            @endforeach 
          </select>
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