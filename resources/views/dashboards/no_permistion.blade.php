@extends('layouts.app')

@section('content')

					   <!-- BEGIN CONTENT BODY -->
                <div class="page-content">
                    <!-- BEGIN PAGE HEAD-->
                   
                    <div class="row">
                        <div class="col-md-12 page-500">
                            <div class=" number font-red">  </div>
                            <div class=" details">
                                <h3>عذرا !</h3>
                                <p> لا لكنك لا تستطيع الدخول لهذه الصفحة
                                    <br/> </p>
                                <p>
                                    <a href="{{asset('dashboard')}}" class="btn red btn-outline"> الرجوع للرئيسية </a>
                                    <br> </p>
                            </div>
                        </div>
                    </div>
                    <!-- END PAGE BASE CONTENT -->
                </div>
                <!-- END CONTENT BODY -->
                   
@endsection
