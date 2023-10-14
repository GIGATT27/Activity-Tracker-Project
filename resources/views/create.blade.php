
   
@extends('layouts.app')

@section('title','Create Activity')

@section('content')

@auth

<div class="main-content">
    <section class="section">
      <div class="section-body">
<div class="card">
    <div class="card-header">
        <h1>Create Activity</h1>
      </div>
      
    <div class="card-body">
    <form method="POST" action="/create-activity">
        @csrf

        <div class="form-group">
            <label for="name">Activity Name:</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="description">Description:</label>
            <textarea name="description" id="description" class="form-control"></textarea>
        </div>

        <div class="form-group">
            <label for="status">Status:</label>
            <select name="status" id="status" class="form-control">
                <option value="pending">Pending</option>
                <option value="done">Done</option>
            </select>
        </div>

        <div class="form-group">
            <label for="remarks">Remarks:</label>
            <textarea name="remarks" id="remarks" class="form-control"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Create Activity</button>
    </form>
    </div>
</div>
</div>
</section>
</div>

@endsection 

@endauth

