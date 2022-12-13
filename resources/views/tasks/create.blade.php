@extends('layouts.app')
@section('links')
@endsection
@section('content')
    <div class="container">
        <div class="row">

            <div class="col-8 offset-2">
                <h4>Add Task</h4>
                <form method="POST" action="{{ route('tasks.store') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="nameAlbum" class="form-label">Name Task</label>
                        <input type="text" name="name" class="form-control" id="nameAlbum" required>

                    </div>
                    <div class="mb-3">
                        <select name="officer" class="form-select" aria-label="Default select example">
                            <option selected disabled>Select officer to do task</option>
                            @if (isset($users) && count($users) > 0)
                                @foreach ($users as $user)
                                    <option value="{{$user->id}}">{{$user->name}}</option>
                                @endforeach
                            @endif
                          </select>
                    </div>
                    <div class="mb-3">
                        <label for="Deadline" class="form-label">Deadline</label>
                        <input type="date" name="deadline" class="form-control" id="Deadline" required>

                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>

        </div>

    </div>
@endsection
