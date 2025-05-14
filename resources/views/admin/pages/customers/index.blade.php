@extends('admin.layouts.master')

@section('admin-title', 'Customers')

@section('admin-content')
    <div class="content-body">
        <div class="d-flex justify-content-between mb-1">
            <div class="">
                <h3>Customers - <span class="badge bg-primary">{{ $customerCount }}</span></h3>
            </div>
            <div class="">
                <a class="btn btn-primary" href="{{ route('admin.manage_customer.customers.create') }}" >Add New Customer</a>
            </div>
        </div>
        @include('admin.partials.message')

        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.manage_customer.customers.index') }}" method="GET">
                    <div class="row">
                        <div class="col-md-8 col-12">
                            <div class="form-group">
                                <label for="search-query" class="sr-only">Search from All customers</label>
                                <input type="text" placeholder="search query" id="search-query" name="search-query"
                                       class="form-control" value="{{ $_GET['search-query'] ?? '' }}" required>
                            </div>
                        </div>

                        <div class="col-md-4 col-12" style="padding-top: 18px;">
                            <div class="">
                                <button type="submit" class="btn btn-primary me-1">Search</button>
                                <a href="{{ route('admin.manage_customer.customers.index') }}" class="btn btn-outline-dark">Clear Search</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Products Table -->
        <div class="card">
            <div class="card-datatable table-responsive p-2">
                <table id="customers_d_table" class="table table table-striped" style="width:100%">
                    <thead>
                    <tr>
                        <th>Sl</th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Created At</th>
                        <th>Last Active At</th>
                        <th width="15%">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($customers as $customer)
                        <tr>
                            <td>{{ $loop->index+1 }}</td>
                            <td>{{ $customer->full_name() }}</td>
                            <td>{{ $customer->phone }}</td>
                            <td>{{ $customer->email }}</td>
                            <td>
                                @if($customer->status == 'active')
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-secondary">Inactive</span>
                                @endif
                            </td>
                            <td>{{ \Carbon\Carbon::parse($customer->updated_at)->format('d M Y h:i A') }}</td>
                            <td></td>
                            <td>
                                <a href="{{ route('admin.manage_customer.customers.show', $customer) }}" class="me-1"><i class="font-medium-4" data-feather='eye'></i></a>
                                <a href="{{ route('admin.manage_customer.customers.edit', $customer) }}" class="me-1"><i class="font-medium-4" data-feather='edit'></i></a>
                                <a href="#" data-bs-target="#deleteCustomerModal-{{ $customer->id }}" data-bs-toggle="modal" class="text-danger"><i class="font-medium-4" data-feather='trash-2'></i></a>
                                <div class="modal fade modal-danger text-start" id="deleteCustomerModal-{{ $customer->id }}" tabindex="-1"
                                     aria-labelledby="deleteCustomerModal-{{ $customer->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteCustomerModal-{{ $customer->id }}">!!! Delete Confirmation !!! <span
                                                        class="badge badge-glow bg-info"> {{ $customer->name }}</span></h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Are you sure to delete this customer? It will not be possible to recover it anymore.
                                            </div>
                                            <form action="{{ route('admin.manage_customer.customers.destroy', $customer) }}"
                                                  method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-outline-danger">Yes, Delete</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="float-end">
                    {{ $customers->links() }}
                </div>
            </div>
        </div>
        <!--/ Products Table -->

    </div>
@endsection

@section('admin-scripts')
    <script>
        $(document).ready(function () {
            $('#customers_d_table').DataTable(
                {
                    paging: false,
                    soring: false,
                }
            );
        });

    </script>
@endsection
