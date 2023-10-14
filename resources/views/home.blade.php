

@extends('layouts.app') 

@section('content')

<div class="main-content">
  <section class="section">
    <div class="section-body">
      <div class="row">
        <div class="col-12">
          <div class="card mb-0">
            <div class="card-body">
              <ul class="nav nav-pills">
                <li class="nav-item">
                  <a class="nav-link active" href="#">All <span class="badge badge-white">{{$activities->count()}}</span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">Draft <span class="badge badge-primary">2</span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">Pending <span class="badge badge-primary">3</span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">Trash <span class="badge badge-primary">0</span></a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div><br>
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4>Activity Table</h4>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-striped" id="table-1">
                  <thead>
                    <tr>
                      <th class="text-center">
                        #
                      </th>
                      <th>Activity Name</th>
                      {{-- <th>Description</th> --}}
                      <th>Members</th>
                      <th>Date Created</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php
                      $taskNumber = 1; // Initialize a counter variable
                    @endphp

                    @foreach ($activities as $activity) 
                     
                    <tr>
                      <td>
                        {{$taskNumber++}}
                      </td>
                      <td>{{$activity->name}}</td>
                      {{-- <td class="align-middle">
                        {{$activity->description}}
                      </td> --}}
                      <td>
                        {{$activity->user->username}} |
                        <img alt="image" src="assets/img/users/user-5.png" width="35">
                      </td>
                      <td>{{$activity->formatted_date_created}}</td>
                      <td>
                        @if ($activity->status === 'done')
                          <div class="badge badge-success badge-shadow">Completed</div>
                        @else
                          <div class="badge badge-warning badge-shadow">Pending</div>
                        @endif
                        
                      </td>
                      <td>
                        <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#exampleModal{{ $activity->id }}">Detail</button>
                        {{-- <a href="#" class="btn btn-outline-primary">Detail</a> --}}
                        
                        <a class="btn btn-primary btn-action mr-1" data-toggle="modal" data-target="#exampleModal2{{ $activity->id }}" data-toggle="tooltip" title="Edit"><i
                          class="fas fa-pencil-alt"></i></a>

                        <a class="btn btn-danger btn-action" data-toggle="tooltip" title="Delete"
                        data-confirm="Are You Sure?|This action can not be undone. Do you want to continue?"
                        data-confirm-yes="alert('Deleted')"><i class="fas fa-trash"></i></a>
                      </td>
                    </tr>
                    @endforeach 
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>     
            </div>
          </div>

          @foreach ($activities as $activity)
          <div class="modal fade" id="exampleModal2{{$activity->id}}" tabindex="-1" role="dialog" aria-labelledby="formModal{{$activity->id}}"
          aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="formModal">Update Activity</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form action="/update-activity/{{$activity->id}}" method="POST">
                  @csrf
                  @method('PUT')
          
                  <div class="form-group">
                      <label for="status">Status</label>
                      <select name="status" id="status" class="form-control">
                          <option value="done" @if ($activity->status === 'done') selected @endif>Done</option>
                          <option value="pending" @if ($activity->status === 'pending') selected @endif>Pending</option>
                      </select>
                  </div>
          
                  <div class="form-group">
                      <label for="remarks">Remarks</label>
                      <textarea name="remarks" id="remarks" class="form-control">{{ $activity->remarks }}</textarea>
                  </div>
          
                  <button type="submit" class="btn btn-primary">Update</button>
              </form>
              </div>
            </div>
          </div>
        </div>
        @endforeach

          @foreach ($activities as $activity)
          <div class="modal fade" id="exampleModal{{ $activity->id }}" tabindex="-1" role="dialog" aria-labelledby="formModal{{ $activity->id}}"
          aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="formModal">Detail View</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
              
                <h3>Description</h3>
                <p>{{$activity->description}}</p>

                <h3>Remarks</h3>
                @if ($activity->remarks)
                  <p>{{$activity->remarks}}</p>
                @else
                  <p>No remarks yet.</p>
                @endif 
                
              </div>
            </div>
          </div>
        </div>
        @endforeach

@endsection