@extends('layouts.app')

@section('title','Activity Log')

@section('content')

<div class="main-content">
  @php
    $today = now()->format('Y-m-d'); // Set $today to the current date
@endphp
  <div class="col-12 col-md-6 col-lg-6">
    <div class="card">
        <div class="card-header">
            <h4>Updated Activities</h4>
        </div>

        <div class="card-body p-0">
            <div class="form-group">
                {{-- <label for="dateSelector">Select Date:</label>
                <select id="dateSelector" class="form-control">
                    @foreach ($dailyUpdates as $date => $activities)
                        <option value="{{ $date }}" @if ($date === $today) selected @endif>{{ $date }}</option>
                    @endforeach
                </select> --}}
                <label for="datePicker">Select Date:</label>
                <input type="date" id="datePicker" class="form-control">
            </div>
            
            <div class="table-responsive" id="activityTable">
                <table class="table table-striped table-md">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Activity Name</th>
                            <th>Created At</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $counter = 1 @endphp
                        @foreach ($dailyUpdates[$today] as $activity)
                            @if ($activity->updates->isNotEmpty())
                                <tr>
                                    <td>{{ $counter++ }}</td>
                                    <td>{{ $activity->name }}</td>
                                    <td>{{ $today }}</td>
                                    <td>
                                        <div class="badge badge-success">Active</div>
                                    </td>
                                    <td><a href="#" class="btn btn-primary">Detail</a></td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card-footer text-right">
            <nav class="d-inline-block">
                <ul class="pagination mb-0">
                    <li class="page-item disabled">
                        <a class="page-link" href="#" tabindex="-1"><i class="fas fa-chevron-left"></i></a>
                    </li>
                    <li class="page-item active"><a class="page-link" href="#">1 <span class="sr-only">(current)</span></a></li>
                    <li class="page-item">
                        <a class="page-link" href="#">2</a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#"><i class="fas fa-chevron-right"></i></a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>


@foreach ($dailyUpdates as $date => $activities)
    <h2>{{ $date }}</h2>
    <ul>
        @php $displayedActivities = []; @endphp
        @foreach ($activities as $activity)
            {{-- @if (!in_array($activity->id, $displayedActivities))
                <li>
                    {{ $activity->name }} - {{ $activity->status }}
                </li>
                @php $displayedActivities[] = $activity->id; @endphp
            @endif --}}
            @if ($activity->updates->isNotEmpty())
            <li>
                {{ $activity->name }} - {{ $activity->status }}
            </li>
            @foreach ($activity->updates as $update)
                <p>{{ $update->user->name }} updated at {{ $update->created_at }}: {{ $update->status }} - {{ $update->remarks }}</p>
            @endforeach
            @endif
        @endforeach
    </ul>
@endforeach

</div>

@endsection