@extends('admin.layouts.master')

@section('admin-title', 'Contact Requests')

@section('admin-content')
    <div class="content-body">
        <div class="d-flex justify-content-between mb-2">
            <div class="">
                <h3>Customer Contact Requests - <span class="badge bg-primary">{{ countContactRequests() }}</span></h3>
            </div>
        </div>
        @include('admin.partials.message')

        <!-- Products Table -->
        <div class="card">
            <div class="card-datatable table-responsive p-2">
                <table id="contact_requests_d_table" class="table table table-striped" style="width:100%">
                    <thead>
                    <tr>
                        <th>Sl</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Subject</th>
                        <th>Phone</th>
                        <th>Reply Status</th>
                        <th>Ip Address</th>
                        <th>Created At</th>
                        <th>Actions</th>
                        <th>Others</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($contacts as $contact)
                        <tr>
                            <td>{{ $loop->index+1 }}</td>
                            <td>{{ $contact->name }}</td>
                            <td>{{ $contact->email }}</td>
                            <td>{{ $contact->subject }}</td>
                            <td>{{ $contact->phone }}</td>
                            <td>
                                @php
                                    $status = $contact->is_replied ? 'Replied' : 'Pending';
                                    $badge = $contact->is_replied ? 'badge bg-primary rounded-pill' : 'badge bg-danger rounded-pill';
                                @endphp
                                <span class="{{ $badge }}">{{ $status }}</span>
                            </td>
                            <td>{{ $contact->ip_address }}</td>
                            <td>{{ \Carbon\Carbon::parse($contact->created_at)->format('Y-m-d H:i:s A')  }}</td>
                            <td>
                                <a href="{{ route('admin.crm.contact_requests.show', $contact->id) }}" class="me-1"><i class="font-medium-4" data-feather='eye'></i></a>
                                <a href="#" data-bs-target="#deleteContactReqModal-{{ $contact->id }}" data-bs-toggle="modal" class="text-danger"><i class="font-medium-4" data-feather='trash-2'></i></a>
                                @include('admin.pages.crm.contact-requests.partials.deleteContactReqModal')
                            </td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0"
                                            data-bs-toggle="dropdown">
                                        <i data-feather="more-vertical"></i>
                                    </button>

                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a class="dropdown-item"
                                           href="{{ route('admin.crm.contact_requests.mark_as_replied', $contact->id) }}"
                                        >
                                            <i data-feather="edit" class="me-50"></i>
                                            <span>Mark as Replied</span>
                                        </a>

                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="float-end">
                    {{ $contacts->links() }}
                </div>
            </div>
        </div>
        <!--/ Products Table -->
    </div>
@endsection

@section('admin-scripts')
    <script>
        $(document).ready(function () {
            $('#contact_requests_d_table').DataTable(
                {
                    paging: false,
                    soring: false,
                }
            );
        });

    </script>
@endsection
