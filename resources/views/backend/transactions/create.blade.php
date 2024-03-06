<x-app-layout title="Transaction">
 
    <x-slot name="header">

    <div class="row mb-2">
        <div class="col-sm-6">
<!--             <h1 class="font-semibold text-xl text-gray-800 leading-tight">
               Transaction Management
            </h1> -->
        </div>

        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('transactions.index') }}">Transaction List</a></li>
                <li class="breadcrumb-item active">Transaction Create</li>
            </ol>
        </div>
    </div>

    </x-slot>

    <div class="row">
        <div class="col-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Create New Transaction</h3>
                </div>
              <!-- /.card-header -->

                <!-- form start -->
                <form action="{{ route('transactions.store') }}" method="POST">
                @csrf

                <div class="card-body">

	                <div class="form-group">
	                    <label>Category <span class="text-red">*</span></label>
	                    <select name="category_id" class="form-control select2" id="category_id" style="width: 100%;">
	                        <option value="">Select Category</option>
	                        @foreach($categories as $category)
	                        <option value="{{ $category->id }}">{{ $category->name }}</option>
	                        @endforeach
	                    </select>
	                </div>

                    <div class="form-group">
                        <label>Sub Category</label>
                        <select name="sub_category_id" class="form-control select2" id="sub_category_id" style="width: 100%;">
                            
                        </select>
                    </div>

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
<script type="text/javascript">
$('select[name="category_id"]').on('change', function(){
    var category_id = $(this).val();
    getSubCategory(category_id);

    $('select[name="sub_category_id"]').empty();

});

function getSubCategory(category_id)
{
console.log(category_id);
    if(category_id) {
        var url = '{{ route("ajax.get-sub-category") }}';
        $.ajax({
            url: url,
            type:"POST",
            dataType:"json",
            data : {
                "_token": "{{ csrf_token() }}",
                "category_id" : category_id
            },
            success:function(data) {
                $('select[name="sub_category_id"]').append('<option value="0">Select Sub Category</option>');

                $.each(data, function(key, value){

                  $('select[name="sub_category_id"]').append('<option value="'+ value.id +'">' + value.name + '</option>');
                });
    
            },
        });
    } 
}
</script>
@endpush

</x-app-layout>

