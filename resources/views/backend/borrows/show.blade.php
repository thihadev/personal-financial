<x-app-layout title="Debits">
 
    <x-slot name="header">

    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="font-semibold text-xl text-gray-800 leading-tight">
               {{$title}} 
            </h1>
        </div>

        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">{{$title}} </li>
            </ol>
        </div>
    </div>

    </x-slot>

    <div class="row">
        <div class="col-12">
            <!-- Default box -->
            <div class="card">
                <div class="card-header">
                    <div class="card-tool">
                        <a href="#paybackModal" data-toggle="modal" data-id="{{ $borrow->id }}" class="btn btn-primary float-right">Add New Payback</a>
                    </div>
                </div>

                <div class="card-body">
                    
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
                            <th class="text-right py-0 align-middle">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($borrow->history)
                        @foreach($borrow->history as $key => $transaction)
                        <tr>
                            <td class="bg-{{$transaction->type->color()}}" style="width: 0.2px !important"></td>
                            <td> {{ $key + 1 }}</td>
                            <td> {{ $transaction->user ?? '-' }}</td>
                            <td> {{ $transaction->wallet?->wallet_name }}</td>
                            <td class="text-right text-bold">{{ number_format($transaction->amount) }}</td>
                            <td class="text-right text-bold">{{ $transaction->fees }}</td>
                            <td>{{ $transaction->description }}</td>
                            <td> {{ $transaction->date->format('d-m-Y') }}</td>
                            <td class="text-right py-0 align-middle">
                                <a href="{{ route('transactions.show', $transaction) }}" class="btn btn-primary">
                                  <i class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                        @endif
                        <tr>
                            <td colspan="9" class="text-center">There is no history..</td>
                        </tr>
                    </tbody>
                    </table>
                </div>

                <!-- /.card-body -->
                <div class="card-footer">

                </div>
              <!-- /.card-footer-->
            </div>
            <!-- /.card -->
        </div>
    </div>

    <div class="modal fade" id="paybackModal" role="dialog" aria-hidden="true">
        <form id="paybackForm" method="POST">
            @csrf
            @method('PATCH')

            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">PAYBACK ({{$borrow->type->name}})</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                        <label for="amount">Amount <span class="text-red">*</span></label>
                        <x-input type="number" name="amount" value="{{abs($borrow->amount)}}" autocomplete="off"/>
                    </div>

                    <div>
                        <div class="form-group">
                            <label for="user">{{ $borrow->type->value == 3 ? "From" : "To"}}</label>
                            <x-input type="text" readonly name="user" value="{{$borrow->user}}" autocomplete="off"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="date">Date <span class="text-red">*</span></label>
                        <x-input type="date" name="date" value="{{ date('Y-m-d') }}" autocomplete="off"/>
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea type="description" name="description" class="form-control" rows="5"></textarea>
                    </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-{{( $borrow->type->value == 3) ? "success" : "danger"}}">Submit</button>
                    </div>
                </div>
            </div>
        </form>
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