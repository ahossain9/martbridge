@extends('admin.layouts.master')

@section('admin-title', 'Newsletter Subscribers')

@section('admin-content')
    <div class="content-body">
        <div class="d-flex justify-content-between mb-2">
            <div class="">
                <h3>Newsletter Subscribers - <span class="badge bg-primary">{{ $newsletterSubscribersCount }}</span></h3>
            </div>
        </div>
        @include('admin.partials.message')

        <!-- Products Table -->
        <div class="card">
            <div class="card-datatable table-responsive p-2">
                <table id="newsletter_subscriber_d_table" class="table table table-striped" style="width:100%">
                    <thead>
                    <tr>
                        <th>Sl</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>IP Address</th>
                        <th>Subscribed At</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($newsletterSubscribers as $subscriber)
                        <tr>
                            <td>{{ $loop->index+1 }}</td>
                            <td>{{ $subscriber->email }}</td>
                            <td>
                                @if($subscriber->status == 1)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-secondary">Inactive</span>
                                @endif
                            </td>
                            <td>{{ $subscriber->ip }}</td>
                            <td>{{ \Carbon\Carbon::parse($subscriber->created_at)->format('Y-m-d H:i:s A')  }}</td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0"
                                            data-bs-toggle="dropdown">
                                        <i data-feather="more-vertical"></i>
                                    </button>

<!--                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a class="dropdown-item"
                                           href=""
                                        >
                                            <i data-feather="edit" class="me-50"></i>
                                            <span></span>
                                        </a>
                                    </div>-->
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="float-end">
                    {{ $newsletterSubscribers->links() }}
                </div>
            </div>
        </div>
        <!--/ Products Table -->
    </div>
@endsection

@section('admin-scripts')
    <script>
        $(document).ready(function () {
            $('#newsletter_subscriber_d_table').DataTable(
                {
                    paging: false,
                    soring: false,
                }
            );
        });

    </script>
@endsection
