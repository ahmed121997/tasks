@extends('layouts.app')

@section('links')
    
@endsection

@section('content')
    <div class="container" style="font-size: 1.4em">
        @if (Session::has('success_update'))
            <div class="message text-success"><i class="fa fa-check-circle" aria-hidden="true"></i>
                {{ Session::get('success_update') }}</div>
        @endif
        @if (Session::has('message'))
            <div class="message text-success"><i class="fa fa-check-circle" aria-hidden="true"></i>
                {{ Session::get('message') }}</div>
        @endif
        <div class="card">
            <div class="card-header h4">{{ __('Profile') }}</div>

            <div class="card-body mt-3">

                <div class="card-body">
                    <div><span class="text-primary">{{ __('name') }} : </span> {{ Auth::user()->name }}</div>
                    <div><span class="text-primary">{{ __('email') }} : </span> {{ Auth::user()->email }}</div>
                    <div><span class="text-primary">{{ __('last edit') }} : </span> {{ Auth::user()->updated_at }}</div>
                    <div><span class="text-primary">{{ __('# All Tasks') }} : </span> {{ Auth::user()->tasks()->count() }}
                    </div>
                    <div><span class="text-primary">{{ __('# Done Tasks') }} : </span> {{ $count }}</div>
                    <div class="text-right">
                        <a class="btn btn-primary  mr-3 mt-3" href="{{ route('user.edit') }}">Edit</a>
                        <a class="btn btn-primary mr-3 mt-3" href="{{ route('user.change.password') }}">Change Password</a>
                    </div>
                </div>
            </div>
        </div>
    @endsection
