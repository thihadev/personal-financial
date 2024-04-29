<x-app-layout title="Borrow">
 
    <x-slot name="header">

    <div class="row mb-2">
        <div class="col-sm-6">
<!--             <h1 class="font-semibold text-xl text-gray-800 leading-tight">
               Borrow Management
            </h1> -->
        </div>

        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('borrows.index') }}">Borrow List</a></li>
                <li class="breadcrumb-item active">Borrow Create</li>
            </ol>
        </div>
    </div>

    </x-slot>

    <div class="row">
        <div class="col-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Create New Borrow</h3>
                </div>
              <!-- /.card-header -->

                <!-- form start -->
                <form action="{{ route('borrows.store') }}" method="POST">
                @csrf

                <div class="card-body">

                    <div class="form-group">
                        <label>Wallet <span class="text-red">*</span></label>
                        <select name="wallet_id" class="form-control select2" id="wallet_id" style="width: 100%;">
                            <option value="">Select Wallet</option>
                            @foreach($wallets as $wallet)
                            <option value="{{ $wallet->id }}">{{ $wallet->wallet_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Type <span class="text-red">*</span></label>
                        <select name="type" class="form-control select2" id="type" style="width: 100%;">
                            <option value="">Select Type</option>
                            <option value="3">Lend</option>
                            <option value="4">Borrow</option>
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

                    <div id="4">
                        <div class="form-group">
                            <label for="user">From <span class="text-red">*</span></label>
                            <x-input type="text" name="from_user" value="" autocomplete="off"/>
                        </div>
                    </div>

                    <div id="3">
                        <div class="form-group">
                            <label for="user">To <span class="text-red">*</span></label>
                            <x-input type="text" name="to_user" value="" autocomplete="off"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="date">Date <span class="text-red">*</span></label>
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
<script type="text/javascript">
$('#3').hide();
$('#4').hide();

$('select[name="type"]').on('change', function(){
    var type = $(this).val();

    if (type == 3) {
        $('#3').show();
        $('#4').hide();
    } else {
        $('#3').hide();
        $('#4').show();
    }

});

</script>
@endpush

</x-app-layout>

