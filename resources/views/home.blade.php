@extends('layouts.app')
@section('links')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.2/css/all.min.css" integrity="sha512-u7ppO4TLg4v6EY8yQ6T6d66inT0daGyTodAi6ycbw9+/AU8KMLAF7Z7YGKPMRA96v7t+c7O1s6YCTGkok6p9ZA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection
@section('content')
    <div class="container">

        <div class="card">
            <div class="card-header h2">{{ __('Tasks') }}</div>

            <div class="card-body mt-3">
                <div class="text-center table-responsive-xxl">
                    <table class="table table-bordered cell-border yajra-datatable">
                        <thead>
                            <tr>
                                <th class="no">No</th>
                                <th class="name">Name</th>
                                <th class="dec">Description</th>
                                <th class="deadline">Deadline</th>
                                @if (auth()->user()->isAdmin())
                                    <th class="officer">Officer</th>
                                @endif
                                <th class="status">Status</th>
                                @if (auth()->user()->isAdmin())
                                    <th class="action">Action</th>
                                @endif
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
                        data: 'dec',
                        name: 'dec'
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
                        name: 'status',
                    },
                    @if (auth()->user()->isAdmin())
                    {
                        data: 'action',
                        name: 'action',
                        orderable: true,
                        searchable: true,
                    },
                    @endif
                ]
            });
        });
    </script>
@endsection
