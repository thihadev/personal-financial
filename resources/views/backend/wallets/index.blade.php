<x-app-layout title="Wallet Management">
 
    <x-slot name="header">

    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="font-semibold text-xl text-gray-800 leading-tight">
               Wallet Management
            </h1>
        </div>

        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Wallet List</li>
            </ol>
        </div>
    </div>

    </x-slot>

    <div class="row">
        <div class="col-12">
            <!-- Default box -->
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Wallet List</h2>
                    <div class="card-tool">
                        <a href="{{ route('wallets.create') }}" class="btn btn-primary float-right">Add New Wallet</a>
                    </div>
                </div>

                <div class="card-body">
                    <table class="table table-bordered">
                    <thead>
                        <tr>
                          <th style="width: 10px">#</th>
                          <th>Payment Name</th>
                          <th>User</th>
                          <th class="text-right py-0 align-middle">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($wallets as $key => $wallet)
                        <tr>
                            <td> {{ $key + 1 }}</td>
                            <td> {{ $wallet->bank_id }}</td>
                            <td> {{ $wallet->user_id }}</td>
                            <td class="text-right py-0 align-middle">
                                <a href="{{ route('wallets.edit', $wallet) }}" class="btn btn-primary">
                                  <i class="fas fa-edit"></i>
                                </a>
                                <a href="#deleteModal" data-toggle="modal" data-id="{{ $wallet->id }}" class="btn btn-danger">
                                  <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    </table>
                </div>

                <!-- /.card-body -->
                <div class="card-footer">
                    <ul class="pagination m-0 float-right">
                      {{ $wallets->appends($_GET)->links() }}
                    </ul>
                </div>
              <!-- /.card-footer-->
            </div>
            <!-- /.card -->
        </div>
    </div>


@include('includes.delete-modal')

@section('styles')

@endsection

@push('scripts')
<script>
    $(function () {
        // Delete modal script.
        $("#deleteModal").on("show.bs.modal", function(e) {
            var id = $(e.relatedTarget).attr('data-id');
            $('#deleteForm').attr('action', `${location.href.split('?')[0]}/${id}`)
        });
    });
</script>
@endpush

</x-app-layout>