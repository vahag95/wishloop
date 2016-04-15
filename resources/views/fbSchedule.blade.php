@extends('layouts.app')

@section('title') Facebook Schedule Post @stop

@section('content')
	<div class="container">
		<div class="row">
			<h3>Publishig post to facebook</h3>
		</div>
		<div>
			<form role="form">
			  <div class="form-group">
			    <label for="date">select start date of publish</label>
			    <select class="form-control">
			    	<option>2016-02-25</option>
			    	<option>2016-02-26</option>
			    	<option>2016-02-27</option>
			    	<option>2016-02-28</option>
			    	<option>2016-02-29</option>
			    	<option>2016-03-01</option>
			    	<option>2016-03-02</option>
			    	<option>2016-03-03</option>
			    	<option>2016-03-04</option>
			    </select>
			  </div>
			  <div class="form-group">
			    <label for="date">Frequancy</label>
			    <select class="form-control">
			    	<option>1</option>
			    	<option>2</option>
			    	<option>3</option>
			    	<option>4</option>
			    	<option>5</option>
			    	<option>6</option>
			    	<option>7</option>
			    	<option>8</option>
			    	<option>9</option>
			    </select>
			  </div>		
			  <div class="form-group">
			    <label for="date">Duration</label><br>			   			   
			    
			    <input type="radio" name="schedule" value="weekly"><span>week</span><br>
			    
			    <input type="radio" name="schedule" value="monthly"><span>month</span><br>
			    
			    <input type="radio" name="schedule" value="monthly"><span>year</span>
			  </div>			  
			  <button type="button" class="btn btn-default" style="color:white; background:#99A1AE; border-radius:15px"><img src="/assets/img/Facebook-logo.png" width="20" height="20" style="border-radius:2px;margin-right:15px"><b>Share</b></button>
			</form>
		</div>
	</div>
@stop