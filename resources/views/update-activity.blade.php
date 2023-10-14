
@extends('layouts.app')

@section('title','Update Activity')

@section('content')


<div class="modal fade" id="activityUpdatesModal" tabindex="-1" role="dialog" aria-labelledby="activityUpdatesModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="activityUpdatesModalLabel">Activity Updates</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <ul>
                    @foreach ($updates as $update)
                        <li>
                            {{ $update->update_timestamp->format('Y-m-d H:i:s') }}: {{ $update->remarks }}
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>

@endsection