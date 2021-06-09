@extends('layouts.app')
@section('content')
<br><br>
<div class="about-us">
	<h1>About Us</h1>
	
</div>
<ul class="nav nav-tabs" id="myTab" role="tablist">
	<li class="nav-item">
	  <a class="nav-link active" id="about-tab" data-toggle="tab" href="#about" role="tab" aria-controls="about" aria-selected="true">Tenanats</a>
	</li>
	<li class="nav-item">
		<a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">LandLord</a>
	  </li>
  </ul>
  <div class="tab-content" id="myTabContent">
	<div class="tab-pane fade show active" id="about" role="tabpanel" aria-labelledby="about-tab">
	  
	  <div style="height: 200px"class="card mb-3">
		<div id="Details" class="tabcontent">
			<div class="card-header">
				<h1>Tenants</h1>
			</div>
			  <div class="card-body">
				<p>Finding a home should not be a mission;
					That is why we at <a href="/">AlphaComodate</a> have 
					made that commitment to help you find the perfect home.</p>
					
					<div class="btn btn-primary">
					  <a style="color: white" class="nav-link" href="/properties"><b>Begin your search <i class="fa fa-search"></i></b></a>
				  </div>						
			  </div>
			 
			{{-- <div class="card-footer text-muted">       
			</div> --}}
		  </div>
		</div>
	</div>
	<div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
	  <div style="height: 200px" class="card mb-3">
		  <div id="contact" class="tabcontent">
			<div class="card">
				<div class="card-header">
					<h1>Landlords</h1>
				</div>
				<div class="card-body">
					<div class="btn btn-primary">
						<a style="color: white" class="nav-link" href="/properties/create"><b>Add a listing</b></a>
					</div>
					<br><br>
				<p>We at <a href="/">AlphaComodate</a> believe that landlords should get the best tenants for their properties at no extra cost. we advertise your property for as long as you want without any fee or cost.
To advertise your property, <a href="/login">signup</a> in just under 2 minutes and you can start advertising your properties.</p>
					
					
				</div>
			</div>  
	  </div>
  </div>
  </div>
  </div>
  <br><br><br><br><br><br><br>
@endsection