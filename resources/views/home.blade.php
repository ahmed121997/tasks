@extends('layouts.app')
@section('links')
    <link href="{{ asset('/css/home.css') }}" rel="stylesheet">
@endsection
@section('content')
    <div class="container">

        <div class="card">
            <div class="card-header">{{ __('Tasks') }}</div>

            <div class="card-body">

                <div class=" mt-5 ">
                    <h2 class="mb-4">My Tasks :</h2>
                </div>
                <div class="text-center">
                    <table class="table table-bordered yajra-datatable cell-border">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Deadline</th>
                                @if (auth()->user()->isAdmin())
                                    <th>Officer</th>
                                @endif
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script src="{{ asset('js/home.js') }}"></script>
    <script type="text/javascript">
        /** datatables*/
        $(function() {
            var table = $('.yajra-datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('tasks.list') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'dead_line',
                        name: 'dead_line'
                    },
                    @if (auth()->user()->isAdmin())
                        {
                            data: 'officer',
                            name: 'officer'
                        },
                    @endif {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: true,
                        searchable: true,
                    },
                ]
            });
        });
    </script>
@endsection
