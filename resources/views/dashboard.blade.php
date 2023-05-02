<x-app-layout title="Dashboard">
 
    <x-slot name="header">

    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="font-semibold text-xl text-gray-800 leading-tight">
               Dashboard
            </h1>
        </div>

        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <!-- <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li> -->
            </ol>
        </div>
    </div>

    </x-slot>

    <div class="row">
        <!-- Default box -->
        <div class="col-lg-3 col-6">
            <div class="small-box bg-primary">
                <div class="inner">
                    <h4>Main Balance</h4>
                    <h5>{{ number_format($balance) }}</h5>
                </div>
                <div class="icon">
                    <i class="fas fa-wallet"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h4>Expense</h4>
                    <h5>{{ number_format($expense) }}</h5>
                </div>
                <div class="icon">
                    <i class="fas fa-wallet"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>

    <div class="row">
        @foreach($wallets as $wallet)
        <!-- Default box -->
        <div class="col-lg-3 col-6">
            <div class="small-box bg-default">
                <div class="inner">
                    <h4>{{ $wallet->bank?->name }}</h4>
                    <h5>{{ number_format($wallet->balance) }}</h5>
                </div>
                <div class="icon">
                    <i class="fas fa-cash"></i>
                </div>
                <!-- <a href="#" class="small-box-footer"><i class="fas fa-arrow-circle-right"></i></a> -->
            </div>
        </div>
        @endforeach
    </div>

@section('styles')

@endsection

@push('scripts')

@endpush

</x-app-layout>
