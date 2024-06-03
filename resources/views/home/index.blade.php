@extends('layouts.master')
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
						  <p class="mg-b-0">Sales monitoring dashboard template.</p>
						</div>
					</div>

				</div>
				<!-- /breadcrumb -->
@endsection
@section('content')
				<!-- row -->
				<div class="row row-sm">
					<div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
						<div class="card overflow-hidden sales-card bg-primary-gradient">
							<div class="pl-3 pt-3 pr-3 pb-2 pt-0">
								<div class="">
									<h5 class="mb-3 tx-12 text-white">Receving invoice</h5>
								</div>
								<div class="pb-0 mt-0">
									<div class="d-flex">
										<div class="">
											<h6 class="tx-20 font-weight-bold mb-1 text-white">
                                                count
                                            </h6>
										</div>
										<span class="float-right my-auto ml-auto">
											<span class="tx-30 font-weight-bold mb-1 text-white">{{\App\Models\receivinginvoice::count()}}</span>
										</span>
									</div>
								</div>
							</div>
							<span id="compositeline" class="pt-1">5,9,5,6,4,12,18,14,10,15,12,5,8,5,12,5,12,10,16,12</span>
						</div>
					</div>
					<div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
						<div class="card overflow-hidden sales-card bg-danger-gradient">
							<div class="pl-3 pt-3 pr-3 pb-2 pt-0">
								<div class="">
									<h6 class="mb-3 tx-12 text-white">Issuing invoice</h6>
								</div>
								<div class="pb-0 mt-0">
									<div class="d-flex">
										<div class="">
											<h6 class="tx-20 font-weight-bold mb-1 text-white">
                                              count
                                            </h6>
										</div>
										<span class="float-right my-auto ml-auto">
											<span class="tx-30 font-weight-bold mb-1 text-white">{{\App\Models\invoice_iss::count()}}</span>
										</span>
									</div>
								</div>
							</div>
							<span id="compositeline2" class="pt-1">3,2,4,6,12,14,8,7,14,16,12,7,8,4,3,2,2,5,6,7</span>
						</div>
					</div>
					<div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
						<div class="card overflow-hidden sales-card bg-success-gradient">
							<div class="pl-3 pt-3 pr-3 pb-2 pt-0">
								<div class="">
									<h6 class="mb-3 tx-12 text-white">vendors</h6>
								</div>
								<div class="pb-0 mt-0">
									<div class="d-flex">
										<div class="">
											<h6 class="tx-20 font-weight-bold mb-1 text-white">
                                                count
                                            </h6>
										</div>
										<span class="float-right my-auto ml-auto ">

											<span class="tx-30 font-weight-bold mb-1 text-white">{{\App\Models\vendor::count()}}</span>
										</span>
									</div>
								</div>
							</div>
							<span id="compositeline3" class="pt-1">5,10,5,20,22,12,15,18,20,15,8,12,22,5,10,12,22,15,16,10</span>
						</div>
					</div>
					<div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
						<div class="card overflow-hidden sales-card bg-warning-gradient">
							<div class="pl-3 pt-3 pr-3 pb-2 pt-0">
								<div class="">
									<h6 class="mb-3 tx-12 text-white">client</h6>
								</div>
								<div class="pb-0 mt-0">
									<div class="d-flex">
										<div class="">
											<h6 class="tx-20 font-weight-bold mb-1 text-white">
                                                count
                                            </h6>
										</div>
										<span class="float-right my-auto ml-auto">

											<span class="tx-30 font-weight-bold mb-1 text-white">
                                                {{\App\Models\client::count()}}
                                            </span>

										</span>
									</div>
								</div>
							</div>
							<span id="compositeline4" class="pt-1">5,9,5,6,4,12,18,14,10,15,12,5,8,5,12,5,12,10,16,12</span>
						</div>
					</div>
				</div>
				<!-- row closed -->

				<!-- row opened -->
				<div class="row row-sm">
					<div class="col-md-12 col-lg-12 col-xl-7">
						<div class="card">
							<div class="card-header bg-transparent pd-b-0 pd-t-20 bd-b-0">
{{--								<div class="d-flex justify-content-between">--}}
{{--									<h4 class="card-title mb-0">Order status</h4>--}}
{{--									<i class="mdi mdi-dots-horizontal text-gray"></i>--}}
{{--								</div>--}}
{{--								<p class="tx-12 text-muted mb-0">Order Status and Tracking. Track your order from ship date to arrival. To begin, enter your order number.</p>--}}
							</div>
							<div class="card-body" style="width: 80%">
                              {!! $chartjs->render() !!}
							</div>

						</div>
					</div>
					<div class="col-lg-12 col-xl-5">

						<div class="card card-dashboard-map-one">
                            <label class="main-content-label">   </label>
							<label class="main-content-label">Abouts company :</label>
                            <label class="main-content-label">   </label>
							<span class="d-block mg-b-20 text-muted tx-12">Provide logistics, administrative transactions, contracts signature and tenders with companies and have a factory for their products</span>
                            <label class="main-content-label">   </label>
                            <label class="main-content-label">E-mail :</label>
                            <span class="d-block mg-b-20 text-muted tx-12">jaffarkhalid2020@gmail.com</span>
                            <label class="main-content-label">Phon :</label>
                            <span class="d-block mg-b-20 text-muted tx-12">+967 775 190 521</span>
                            <div class="card-body" style="width: 40%">


                            </div>
						</div>
					</div>
				</div>
				<!-- row closed -->

				<!-- row opened -->

				<!-- row close -->

				<!-- row opened -->

				<!-- /row -->
			</div>
			<!-- /Container -->
		</div>
		<!-- /main-content -->
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
