@extends('layouts.app')
@section('links')
    <link href="{{ asset('/css/home.css') }}" rel="stylesheet">
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
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            @endif
                        </select>
                        @error('officer')
                            <div class="text-danger mb-3">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="dec" class="form-label">Description</label>
                        <textarea type="text" name="dec" class="form-control" id="dec" required></textarea>
                        @error('dec')
                            <div class="text-danger mb-3">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="Deadline" class="form-label">Deadline</label>
                        <input type="date" name="deadline" class="form-control" id="Deadline" required>
                        @error('dealine')
                            <div class="text-danger mb-3">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>

        </div>

    </div>
@endsection
