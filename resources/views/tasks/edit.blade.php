@extends('layouts.app')
@section('links')
@endsection
@section('content')
    <div class="container">
        <div class="row">

            <div class="col-lg-8 offset-lg-2">
                <h4>Update Task</h4>
                <form method="post" action="{{ route('tasks.update',$task->id) }}">
                    @method('PATCH')
                    @csrf
                    <div class="mb-3">
                        <label for="nameAlbum" class="form-label">Name Task</label>
                        <input type="text" name="name" class="form-control" id="nameAlbum" required value="{{$task->name}}">
                        @error('name')
                            <div class="text-danger mb-3">{{ $message }}</div>
                        @enderror

                    </div>
                    <div class="mb-3">
                        <label for="nameAlbum" class="form-label">Officer</label>
                        <select name="officer" class="form-select" aria-label="Default select example">
                            <option selected disabled>Select officer to do task</option>
                            @if (isset($users) && count($users) > 0)
                                @foreach ($users as $user)
                                    <option @if ($user->id == $task->user_id)
                                        selected
                                    @endif value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            @endif
                        </select>
                        @error('officer')
                            <div class="text-danger mb-3">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="dec" class="form-label">Description</label>
                        <textarea type="text" name="dec" class="form-control" id="dec" required>{{$task->dec}}</textarea>
                        @error('dec')
                            <div class="text-danger mb-3">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="Deadline" class="form-label">Deadline</label>
                        <input type="date" name="deadline" class="form-control" id="Deadline" required value="{{$task->dead_line}}">
                        @error('dealine')
                            <div class="text-danger mb-3">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="status" id="status1" value=1 @if ($task->status == 1)
                            checked
                        @endif>
                        <label class="form-check-label" for="status1">
                         Done
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="status" id="status2" value=0 @if ($task->status == 0)
                            checked
                        @endif>
                        <label class="form-check-label" for="status2">
                          Not Done
                        </label>
                      </div>
                      <div class="text-center">
                        <button type="submit" class="btn btn-primary mt-2">Save Task</button>
                      </div>

                </form>
            </div>

        </div>

    </div>
@endsection
