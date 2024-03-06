<x-app-layout title="Wallet Management">
 
    <x-slot name="header">

    <div class="row mb-2">
        <div class="col-sm-6">
            <!-- <h1 class="font-semibold text-xl text-gray-800 leading-tight">
               Wallet Management
            </h1> -->
        </div>

        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('wallets.index') }}">Wallet List</a></li>
                <li class="breadcrumb-item active">Wallet Create</li>
            </ol>
        </div>
    </div>

    </x-slot>

    <div class="row">
        <div class="col-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Create New Wallet</h3>
                </div>
              <!-- /.card-header -->

                <!-- form start -->
                <form action="{{ route('wallets.store') }}" method="POST">
                @csrf

                <div class="card-body">

                    <div class="form-group">
                        <label for="wallet_name">Wallet Name <span class="text-red">*</span></label>
                        <x-input type="text" name="wallet_name" value="" autocomplete="off"/>
                    </div>

                    <div class="form-group">
                        <label for="initial_amount">Initial Amount <span class="text-red">*</span></label>
                        <x-input type="number" name="initial_amount" value="" autocomplete="off"/>
                    </div>

                    <div class="form-group">
                        <label for="note">Note</label>
                        <x-input type="text" name="note" value="" autocomplete="off"/>
                    </div>

                    <!-- <div class="form-group">
                        <label>Wallet User <span class="text-red">*</span></label>
                        <select name="user_id" class="form-control select2" id="user_id" style="width: 100%;">
                            <option value="">Select User</option>
                            @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div> -->

                </div>

                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
        </div>
    </div>

@section('styles')

@endsection

@push('scripts')

@endpush

</x-app-layout>

