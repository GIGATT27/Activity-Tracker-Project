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
            <form method="get" action="/daily-activity-updates">
                @csrf
                <div class="form-group">
                    <label for="date">Select Date:</label>
                    <input type="date" id="date" name="date" class="form-control" value="{{ $selectedDate }}">
                </div>
                <button type="submit" class="btn btn-primary">Show Updates</button>
            </form>
        
            @if ($dailyUpdates->isEmpty())
                <p>No updates found for {{ $selectedDate }}</p>
            @else
                <h2>Activity Updates for {{ $selectedDate }}</h2>
            @endif 
        
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
                        @foreach ($dailyUpdates as $activity)
                        @if ($activity->updates->count() > 0)
                        <tr>
                            <td>{{ $counter++ }}</td>
                            <td>{{ $activity->name }}</td>
                            <td>{{ $activity->created_at }}</td>
                            <td>
                                @if ($activity->status === 'done')
                                    <div class="badge badge-success badge-shadow">Completed</div>
                                @else
                                    <div class="badge badge-warning badge-shadow">Pending</div>
                                @endif
                            </td>
                            <td>
                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#activityUpdatesModal{{ $activity->id }}">Detail</button>
                            </td>
                        </tr>
        
                        <!-- Activity Detail Modal -->
                        <div class="modal fade" id="activityUpdatesModal{{ $activity->id }}" tabindex="-1" role="dialog"
                            aria-labelledby="activityUpdatesModalLabel{{ $activity->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="activityUpdatesModalLabel{{ $activity->id }}">Activity Updates</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <h2 class="section-title">Activity Updates for {{ $activity->name }}</h2>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="activities">
                                                    @foreach ($activity->updates as $update)
                                                    <div class="activity">
                                                        <div class="activity-icon bg-primary text-white">
                                                            <i class="fas fa-comment-alt"></i>
                                                        </div>
                                                        <div class="activity-detail">
                                                            <div class="mb-2">
                                                                <span class="text-job">{{'@' . $update->user->username}}</span>
                                                                <span class="bullet"></span>
                                                                <span class="text-job">{{ $update->created_at }}</span>
                                                            </div>
                                                            @if ($loop->first)
                                                            <p><b>Remarks:</b> {{ $update->remarks }}</p>
                                                            @else
                                                                @php
                                                                    $previousUpdate = $activity->updates[$loop->index - 1];
                                                                @endphp
        
                                                                @if ($update->status != $previousUpdate->status)
                                                                     <p>changed status to <b>{{ $update->status }}</b></p>
                                                                     <p><b>Remarks:</b> {{ $update->remarks }}</p>
                                                                @else
                                                                <p><b>Remarks:</b> {{ $update->remarks }}</p>
                                                                @endif
                                                            @endif
                                                            
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer bg-whitesmoke br">
                                        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
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

<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
          aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <h2 class="section-title">September 2018</h2>
            <div class="row">
              <div class="col-12">
                <div class="activities">
                  <div class="activity">
                    <div class="activity-icon bg-primary text-white">
                      <i class="fas fa-comment-alt"></i>
                    </div>
                    <div class="activity-detail">
                      <div class="mb-2">
                        <span class="text-job text-primary">2 min ago</span>
                        <span class="bullet"></span>
                        <a class="text-job" href="#">View</a>
                        <div class="float-right dropdown">
                          <a href="#" data-toggle="dropdown"><i class="fas fa-ellipsis-h"></i></a>
                          <div class="dropdown-menu">
                            <div class="dropdown-title">Options</div>
                            <a href="#" class="dropdown-item has-icon"><i class="fas fa-eye"></i> View</a>
                            <a href="#" class="dropdown-item has-icon"><i class="fas fa-list"></i> Detail</a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item has-icon text-danger"
                              data-confirm="Wait, wait, wait...|This action can't be undone. Want to take risks?"
                              data-confirm-text-yes="Yes, IDC"><i class="fas fa-trash-alt"></i> Archive</a>
                          </div>
                        </div>
                      </div>
                      <p>Have commented on the task of "<a href="#">Responsive design</a>".</p>
                    </div>
                  </div>
                  <div class="activity">
                    <div class="activity-icon bg-primary text-white">
                      <i class="fas fa-arrows-alt"></i>
                    </div>
                    <div class="activity-detail">
                      <div class="mb-2">
                        <span class="text-job">1 hour ago</span>
                        <span class="bullet"></span>
                        <a class="text-job" href="#">View</a>
                        <div class="float-right dropdown">
                          <a href="#" data-toggle="dropdown"><i class="fas fa-ellipsis-h"></i></a>
                          <div class="dropdown-menu">
                            <div class="dropdown-title">Options</div>
                            <a href="#" class="dropdown-item has-icon"><i class="fas fa-eye"></i> View</a>
                            <a href="#" class="dropdown-item has-icon"><i class="fas fa-list"></i> Detail</a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item has-icon text-danger"
                              data-confirm="Wait, wait, wait...|This action can't be undone. Want to take risks?"
                              data-confirm-text-yes="Yes, IDC"><i class="fas fa-trash-alt"></i> Archive</a>
                          </div>
                        </div>
                      </div>
                      <p>Moved the task "<a href="#">Fix some features that are bugs in the master module</a>" from
                        Progress to Finish.</p>
                    </div>
                  </div>
                  <div class="activity">
                    <div class="activity-icon bg-primary text-white">
                      <i class="fas fa-unlock"></i>
                    </div>
                    <div class="activity-detail">
                      <div class="mb-2">
                        <span class="text-job">4 hour ago</span>
                        <span class="bullet"></span>
                        <a class="text-job" href="#">View</a>
                        <div class="float-right dropdown">
                          <a href="#" data-toggle="dropdown"><i class="fas fa-ellipsis-h"></i></a>
                          <div class="dropdown-menu">
                            <div class="dropdown-title">Options</div>
                            <a href="#" class="dropdown-item has-icon"><i class="fas fa-eye"></i> View</a>
                            <a href="#" class="dropdown-item has-icon"><i class="fas fa-list"></i> Detail</a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item has-icon text-danger"
                              data-confirm="Wait, wait, wait...|This action can't be undone. Want to take risks?"
                              data-confirm-text-yes="Yes, IDC"><i class="fas fa-trash-alt"></i> Archive</a>
                          </div>
                        </div>
                      </div>
                      <p>Login to the system with ujang@maman.com email and location in Bogor.</p>
                    </div>
                  </div>
                
                </div>
              </div>
            </div>
              </div>
            </div>
          </div>
        </div>


{{-- @foreach ($dailyUpdates as $date => $activities)
    <h2>{{ $date }}</h2>
    <ul>
        @php $displayedActivities = []; @endphp
        @foreach ($activities as $activity) --}}
            {{-- @if (!in_array($activity->id, $displayedActivities))
                <li>
                    {{ $activity->name }} - {{ $activity->status }}
                </li>
                @php $displayedActivities[] = $activity->id; @endphp
            @endif --}}
            {{-- @if ($activity->updates->isNotEmpty())
            <li>
                {{ $activity->name }} - {{ $activity->status }}
            </li>
            @foreach ($activity->updates as $update)
                <p>{{ $update->user->name }} updated at {{ $update->created_at }}: {{ $update->status }} - {{ $update->remarks }}</p>
            @endforeach
            @endif
        @endforeach
    </ul>
@endforeach --}}

</div>

@endsection