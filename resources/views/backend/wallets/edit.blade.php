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
                    <h3 class="card-title">Update Wallet</h3>
                </div>
              <!-- /.card-header -->

                <!-- form start -->
                <form action="{{ route('wallets.update', $wallet) }}" method="POST">
                @csrf
                @method("PATCH")

                <div class="card-body">

                    <div class="form-group">
                        <label for="wallet_name">Wallet Name <span class="text-red">*</span></label>
                        <x-input type="text" name="wallet_name" value="{{$wallet->wallet_name}}" autocomplete="off"/>
                    </div>

                    <div class="form-group">
                        <label for="initial_amount">Initial Amount <span class="text-red">*</span></label>
                        <x-input type="number" name="initial_amount" value="{{$wallet->initial_amount}}" autocomplete="off"/>
                    </div>

                    <div class="form-group">
                        <label for="note">Note</label>
                        <x-input type="text" name="note" value="{{ $wallet->note }}" autocomplete="off"/>
                    </div>

                </div>

                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
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

