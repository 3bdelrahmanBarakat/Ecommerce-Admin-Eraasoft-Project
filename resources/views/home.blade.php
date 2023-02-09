@extends('layouts.master')
@section('title')
    لوحة التحكم - برنامج الفواتير
@stop
@section('css')
<!--  Owl-carousel css-->
<link href="{{URL::asset('assets/plugins/owl-carousel/owl.carousel.css')}}" rel="stylesheet" />
<!-- Maps css -->
<link href="{{URL::asset('assets/plugins/jqvmap/jqvmap.min.css')}}" rel="stylesheet">
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="left-content">
						<div>
						  <h2 class="main-content-title tx-24 mg-b-1 mg-b-lg-1">Hi, welcome back!</h2>

						</div>
					</div>
					<div class="main-dashboard-header-right">


					</div>
				</div>
				<!-- /breadcrumb -->
@endsection
@section('content')
				<!-- row -->

					<h1 style="margin-bottom: 50px; font-size: 55px; color: #0162e8;" class="text-center">MaleFashion System</h1>

				<!-- row closed -->

				<!-- row opened -->
				<div class="row row-sm">

					<div class="col-lg-12 col-xl-6">
						<div class="card card-dashboard-map-one">
							<a href="/products"><h2>Products</h2></a>
							<span class="d-block mg-b-20 text-muted tx-12">هنا يمكنك ايجاد منتجاتك و الاضافه والتعديل و الحذف منهم</span>
                            <br>
						</div>
					</div>

					<div class="col-lg-12 col-xl-6">
						<div class="card card-dashboard-map-one">
							<a href="/orders"><h2>Orders</h2></a>
							<span class="d-block mg-b-20 text-muted tx-12">هنا يمكنك ايجاد الاوردارات و البدأ في شحنها</span>
                            <br>
						</div>
					</div>
				</div>
				<!-- row closed -->




			</div>
		</div>
		<!-- Container closed -->
@endsection
@section('js')
<!--Internal  Chart.bundle js -->
<script src="{{URL::asset('assets/plugins/chart.js/Chart.bundle.min.js')}}"></script>
<!-- Moment js -->
<script src="{{URL::asset('assets/plugins/raphael/raphael.min.js')}}"></script>
<!--Internal  Flot js-->
<script src="{{URL::asset('assets/plugins/jquery.flot/jquery.flot.js')}}"></script>
<script src="{{URL::asset('assets/plugins/jquery.flot/jquery.flot.pie.js')}}"></script>
<script src="{{URL::asset('assets/plugins/jquery.flot/jquery.flot.resize.js')}}"></script>
<script src="{{URL::asset('assets/plugins/jquery.flot/jquery.flot.categories.js')}}"></script>
<script src="{{URL::asset('assets/js/dashboard.sampledata.js')}}"></script>
<script src="{{URL::asset('assets/js/chart.flot.sampledata.js')}}"></script>
<!--Internal Apexchart js-->
<script src="{{URL::asset('assets/js/apexcharts.js')}}"></script>
<!-- Internal Map -->
<script src="{{URL::asset('assets/plugins/jqvmap/jquery.vmap.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
<script src="{{URL::asset('assets/js/modal-popup.js')}}"></script>
<!--Internal  index js -->
<script src="{{URL::asset('assets/js/index.js')}}"></script>
<script src="{{URL::asset('assets/js/jquery.vmap.sampledata.js')}}"></script>
@endsection
