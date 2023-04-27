<x-app-layout title="Payment Management">
 
    <x-slot name="header">

    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="font-semibold text-xl text-gray-800 leading-tight">
               Payment Management
            </h1>
        </div>

        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Payment List</a></li>
                <li class="breadcrumb-item active">Payment Create</li>
            </ol>
        </div>
    </div>

    </x-slot>

    <div class="row">
        <div class="col-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Create New Payment</h3>
                </div>
              <!-- /.card-header -->

                <!-- form start -->
                <form action="{{ route('banks.store') }}" method="POST" enctype='multipart/form-data'>
                @csrf

                <div class="card-body">

                    <div class="form-group {{ $errors->has('logo') ? 'has-error' : '' }}">
                        <img for="logo" src="{{url('/img/no-image.png')}}" class="img-responsive uploadImage" style="width: 200px; height: 200px;"><br/><br>
                            <input type="file" id="logo" name="logo" class="uploadImageFile" required>
                        @if ($errors->has('logo'))
                            <span class="help-block">
                              <strong>{{ $errors->first('logo') }} </strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="name">Payment Name</label>
                        <x-input type="text" name="name" autocomplete="off"/>
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
<script>
$(function(){
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

           reader.onload = function (e) {
                $('.uploadImage1').attr('src', e.target.result);
            }

           reader.readAsDataURL(input.files[0]);
        }
    }

   $(".uploadImageFile1").change(function(){
        readURL(this);
    });
});
</script>
@endpush

</x-app-layout>

