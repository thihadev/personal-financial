<x-app-layout title="Exchange Management">
 
    <x-slot name="header">

    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="font-semibold text-xl text-gray-800 leading-tight">
               Exchange Management
            </h1>
        </div>

        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('transactions.index') }}">Exchange List</a></li>
                <li class="breadcrumb-item active">Exchange Create</li>
            </ol>
        </div>
    </div>

    </x-slot>

    <div class="row">
        <div class="col-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Create New Exchange</h3>
                </div>
              <!-- /.card-header -->

                <!-- form start -->
                <form action="{{ route('transactions.store') }}" method="POST">
                @csrf

                <div class="card-body">

	                <div class="form-group">
	                    <label>Category <span class="text-red">*</span></label>
	                    <select name="category_id" class="form-control select2" id="category_id" style="width: 100%;">
	                        <option value="">Select Type</option>
	                        @foreach($categories as $category)
	                        <option value="{{ $category->id }}">{{ $category->name }}</option>
	                        @endforeach
	                    </select>
	                </div>

                    <div class="form-group">
                        <label>Wallet <span class="text-red">*</span></label>
                        <select name="wallet_id" class="form-control select2" id="wallet_id" style="width: 100%;">
                            <option value="">Select Wallet</option>
                            @foreach($wallets as $wallet)
                            <option value="{{ $wallet->id }}">{{ $wallet->bank?->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Exchange Wallet <span class="text-red">*</span></label>
                        <select name="transfer_wallet_id" class="form-control select2" id="transfer_wallet_id" style="width: 100%;">
                            <option value="">Select Wallet</option>
                            @foreach($wallets as $wallet)
                            <option value="{{ $wallet->id }}">{{ $wallet->bank?->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="amount">Amount <span class="text-red">*</span></label>
                        <x-input type="number" name="amount" value="" autocomplete="off"/>
                    </div>

                    <div class="form-group">
                        <label for="fees">Fee</label>
                        <x-input type="number" name="fees" value="" autocomplete="off"/>
                    </div>

                    <div class="form-group">
                        <label for="date">Date</label>
                        <x-input type="date" name="date" value="" autocomplete="off"/>
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea type="description" name="description" class="form-control" rows="5"></textarea>
                    </div>

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

