@extends('layouts.adminapp')
@section('content')

<div id="main" class=main>
	<div class="header container-fluid fixed-top shadow">
		<div class=row>
			<div class=" col-sm-6 fl-small">
				<button class="openbtn" onclick="openNav();">☰ </button>  
				<img src="imgs/logo-sm.png"/>
			</div>
			<div class=" col-sm-3"> </div>
			<div class=" col-sm-3">
			<div class="pt-2 fr-small">
				<div class="dropdown">
					<button class="btn btn-light dropdown-toggle btn-login" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					admin name
					</button>
					<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
						<a class="dropdown-item" href="#">Logout</a>
					</div>
				</div>
				</div>
			</div>
		</div>
	</div>
	<!--------------right panel---------------->
		<div class="container-fluid">
		<div class="row">
			<div class="col-lg-2"></div>
			<div class="col-lg-10">
				<div class="right-panel">
					<!--------------------------------------------------------------------------------------->
				<!--bread crumb-->
				<section class="all-schools my-5 pt-5">
					<div class="container">
						<nav aria-label="breadcrumb">
								<ol class="breadcrumb">
									<li class="breadcrumb-item" aria-current="page">
									{{ App\School::where('id',$school_id)->value('name')}}
									</li>
									<li class="breadcrumb-item " aria-current="page">
									{{ App\Level::where('id',$level_id)->value('name')}}
									</li>
									<li class="breadcrumb-item " aria-current="page">
									{{ App\Year::where('id',$year_id)->value('name')}}
									</li>
									<li class="breadcrumb-item active" aria-current="page">
									{{ App\Classe::where('id',$class_id)->value('name')}}
									</li>
								</ol>
						</nav>
					</div>
				</section>
				<!--/bread crumb-->
				<!----------------------------------------------------------------------------------->
					<!--material-->
					<!--tabs-->
					<div class="material-tab">
					<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
						<li class="nav-item">
							<a class="nav-link active" id="pills-file-tab" data-toggle="pill" href="#pills-file" role="tab" aria-controls="pills-file" aria-selected="true">Files</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" id="pills-video-tab" data-toggle="pill" href="#pills-video" role="tab" aria-controls="pills-video" aria-selected="false">Videos</a>
						</li>
						
						</ul>
					</div>
					<!--tabs content-->
					<div class="tab-content" id="pills-tabContent">
					<div class="tab-pane fade show active" id="pills-file" role="tabpanel" aria-labelledby="pills-file-tab">
						<div class="files-material ml-5">
							<div class="row">
								<div class="col-12">
									<div class="file-upload m-auto">
										@include('partials.errors')
										@include('partials.success_insert')
										<form action="{{  url('/admin/add_material_file') }}" method="post" enctype="multipart/form-data">
											
											{{ csrf_field() }}
											
						
											<input type="hidden" name="class_id" value="{{ $class_id }}">
											<input type="hidden" name="material_id" value="{{ $material_id }}">
											<input type="hidden" name="type" value="file">
											
											<div class="custom-file">
												<input type="file" class="custom-file-input" name = 'file'  required autofocus id="customFile">
												<label class="custom-file-label" for="customFile"><i class="fa fa-folder-plus"></i>Upload Material</label>
												<div class="form-group text-center">
												<button  type = 'submit' class="btn btn-warning ">ADD</button>
											</div>
											</div>
										</form>
													
									</div>
								</div>
								@foreach($files as $file )
								<div class="col-md-3 col-sm-6">
									<div class="file">

										<div class="text-right">
											<form action="{{  url('/admin/delete_material_file') }}" method="post" enctype="multipart/form-data">
												{{ csrf_field() }}
												<input type="hidden" name="id" value="{{ $file->id }}">
												
												<button> 
													<i class="fas fa-minus"></i>
												</button>

											</form> 
										</div>

										<form action="{{  url('/admin/dowload_material_file') }}" method="post" enctype="multipart/form-data">
											{{ csrf_field() }}
											<input type="hidden" name="id" value="{{ $file->id }}">
											{{--  <a href="#">  --}}

												<img class="img-fluid" src="{{ asset('images/'.$file->image) }}" />
												<p class="text-center">{{ $file->file_name }}</p>
												<input type ='submit' value ='download' > 
											{{--  </a>  --}}
										</form>
										
									</div>
									
								</div>
								@endforeach
							
							</div>
						</div>
					</div>
					<!-- videos -->
					<div class="tab-pane fade" id="pills-video" role="tabpanel" aria-labelledby="pills-video-tab">
						<div class="files-material ml-5">
							<div class="row">
								<div class="col-12">
									<div class="file-upload m-auto ">
											
										<form action="{{url('/teacher/add/file')}}" method="post" enctype="multipart/form-data">
											{{ csrf_field() }}
											<input type="hidden" name="class_id" value="{{ $class_id }}">
											<input type="hidden" name="material_id" value="{{ $material_id }}">
											<input type="hidden" name="type" value="video">

											<div class="custom-file">
												<input type="text" class="form-control mt-5" placeholder="Upload Video URl">
											</div>
											<div class="form-group text-center">
												<button class="btn btn-warning my-5">ADD</button>
											</div>
										</form>
													
									</div>
								</div>
								<div class="col-md-3 col-sm-6">
									<div class="file">
										<div class="text-right">
											<i class="fas fa-minus"></i>
										</div>
										<a href="#">
											<img class="img-fluid" src="imgs/video.png"/>
											<p class="text-center">Material1</p>
										</a>
									</div>
								</div>
							
							</div>
						</div>
					</div>
					</div>
					<!--/material-->
				<!----------------------------------------------------------------------------------->
				</div>
			</div>
		</div>
	</div>
</div>

@endsection
