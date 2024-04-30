<x-app-layout title="Debits">
 
    <x-slot name="header">

    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="font-semibold text-xl text-gray-800 leading-tight">
               Debits 
            </h1>
        </div>

        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Debits List</li>
            </ol>
        </div>
    </div>

    </x-slot>

    <div class="row">
        <div class="col-12">
            <!-- Default box -->
            <div class="card">
                <div class="card-header">
                    <form action="{{ route('borrows.index') }}" method="GET">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                        <i class="far fa-calendar-alt"></i>
                                        </span>
                                    </div>
                                    <input type="date" name="date" class="form-control float-right" id="date">
                                </div>

                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <select name="wallet_id" class="form-control js-company-ajax select2" id="wallet_id" style="width: 100%;">
                                        <option value="">Select Payment</option>
                                        @foreach($wallets as $wallet)
                                        <option value="{{$wallet->id}}">{{$wallet->wallet_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <button type="submit" class="mr-3 btn btn-primary" id="submit">
                                        <i class="fa fa-filter"></i> Filter
                                    </button>
<!--                                     <button type="submit" class="mr-3 btn btn-warning" id="clear">
                                        <i class="fa fa-trash"></i> Clear
                                    </button>
                                    <button type="submit" name="btn" value="export" class="mr-3 btn btn-info" id="submit">
                                        <i class="fa fa-download"></i> Export
                                    </button> -->
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="card-body">
                    
                    <h5>Borrow : <span class="text-grey">{{ $total_borrow }}</span></h5>
                    <h5>Lend : <span class="text-grey">{{ abs($total_lend) }}</span></h5>
                    <h5>Residual Amount : <span class="{{$span}}">{{ abs($residual_amount) }}</span></h5>
                    <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="width: 0.2px !important"></th>
                            <th style="width: 10px">#</th>
                            <th>From/To</th>
                            <th>Account</th>
                            <th>Amount</th>
                            <th>Fee</th>
                            <th>Remark</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th class="text-right py-0 align-middle">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($transactions as $key => $transaction)
                        <tr>
                            <td class="bg-{{$transaction->type->color()}}" style="width: 0.2px !important"></td>
                            <td> {{ $key + 1 }}</td>
                            <td> {{ $transaction->user }}</td>
                            <td> {{ $transaction->wallet?->wallet_name }}</td>
                            <td class="text-right text-bold">{{ number_format($transaction->amount) }}</td>
                            <td class="text-right text-bold">{{ $transaction->fees }}</td>
                            <td>{{ $transaction->description }}</td>
                            <td> {{ $transaction->date->format('d-m-Y') }}</td>
                            <td> {{ $transaction->status == 1 ? 'PAID' : '-' }}</td>
                            <td class="text-right py-0 align-middle">
                                <a href="{{ route('borrows.show', $transaction) }}" class="btn btn-primary">
                                  <i class="fas fa-eye"></i>
                                </a>
{{--                                 <a href="#deleteModal" data-toggle="modal" data-id="{{ $transaction->id }}" class="btn btn-danger">
                                  <i class="fas fa-trash"></i>
                                </a> --}}
                            </td>

                        </tr>
                        @endforeach
                    </tbody>
                    </table>
                </div>

                <!-- /.card-body -->
                <div class="card-footer">
                    <ul class="pagination m-0 float-right">
                      {{ $transactions->appends($_GET)->links() }}
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

        @if(!request('date'))
            $('#date').val(null)
        @endif

        // Delete modal script.
        $("#deleteModal").on("show.bs.modal", function(e) {
            var id = $(e.relatedTarget).attr('data-id');
            $('#deleteForm').attr('action', `${location.href.split('?')[0]}/${id}`)
        });

        $('#clear').on('click',function(){
            $('#date').val(null);
            $('#bank_id').val(null).change();
            $("#bank_id option[selected]").removeAttr("selected");            
        });

    });
</script>
@endpush

</x-app-layout>