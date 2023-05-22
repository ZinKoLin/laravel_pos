@extends('admin.admin_master')
@section('admin')


 <div class="page-content">
 <div class="container-fluid">


    <div class="row">
                            <div class="col-md-12 col-xl-6">

                                <!-- Simple card -->
                                <div class="card"><br><br>
                                    <center>
                                     <img class="rounded-circle avatar-xl" alt="200x200"src="{{
                                      (!empty($adminData->profile_image)) ? url('upload/admin_image/'.$adminData->profile_image):url('upload/no_image.jpg')}}" alt="card image cap">


                                    </center>
                                    <div class="card-body">
                                        <h4 class="card-title">Name : {{$adminData->name}}</h4>
                                        <hr>
                                        <h4 class="card-title">Email: {{$adminData->email}}</h4>
                                        <hr>
                                        <a href="{{route('edit.profile')}}" class="btn btn-info btn-rounded waves-effect">Edit Profile</a>


                                    </div>
                                </div>

                            </div><!-- end col -->

                        </div>



 </div>
 </div>


@endsection
