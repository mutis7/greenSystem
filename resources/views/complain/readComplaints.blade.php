@extends('layouts.adminDashboard')

@section('content')

	@forelse($complaints as $complain)
	<div class="col-md-9 col-md-offset-1">
		<div class="panel panel-default">
			<div class="panel-heading">
				{{$complain->email}}
				<span class="pull-right clear-fix">
			 		{{$complain->created_at->diffForHumans()}}
			 	</span>
			</div>
			<div class="panel-body">
			 	{{ $complain->complain }}				
			</div>
		</div>
	</div>
	@empty
	No complaints or suggestions now.
	@endforelse	
@endsection