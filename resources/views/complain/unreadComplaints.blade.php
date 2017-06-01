@extends('layouts.adminDashboard')

@section('content')
<div class="row">
	@forelse($complaints as $complain)
	<div class="col-md-9 col-md-offset-1">
		<div class="panel panel-default">
			<div class="panel-heading">
				{{$complain->email}}
				<span class="pull-right clear-fix">
			 		{{$complain->created_at->diffForHumans()}}
			 	</span>
			</div>
			<div>
				
			</div>
			<div class="panel-body">
			 	{{ $complain->complain }}
				
			</div>
			<div class="panel-footer" style="height:40px;"><a href="{{ url('read/'.$complain->id) }}" class="pull-right btn btn-info btn-xs">mark as read</a></div>
		</div>
	</div>
	@empty
	No complaints or suggestions now.
	@endforelse	
</div>




@endsection