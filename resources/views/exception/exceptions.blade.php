@extends('layouts.adminDashboard')

@section('content')


    @forelse($exceptionJobs as $exceptionJob)
    <div class="col-md-9 col-md-offset-1">
        <div class="panel panel-default">
            <div class="panel-heading">
                {{$exceptionJob->house}} in location {{$exceptionJob->location}}
                <span class="pull-right clear-fix">
                    {{$exceptionJob->created_at->diffForHumans()}}
                </span>
            </div>
            <div class="panel-body">
                {{ $exceptionJob->description }}
            </div>            
        </div>
    </div>
   
    @empty
    No Articles.
    @endforelse 

@endsection
