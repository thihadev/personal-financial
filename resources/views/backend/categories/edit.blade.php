<x-app-layout title="Category Management">
 
    <x-slot name="header">

    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="font-semibold text-xl text-gray-800 leading-tight">
               Category Management
            </h1>
        </div>

        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Category List</a></li>
                <li class="breadcrumb-item active">Category Create</li>
            </ol>
        </div>
    </div>

    </x-slot>

    <div class="row">
        <div class="col-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Create New Category</h3>
                </div>
              <!-- /.card-header -->

                <!-- form start -->
                <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="card-body">

                    {{-- <div class="form-group {{ $errors->has('logo') ? 'has-error' : '' }}">
                        <img for="logo" src="{{ image_path($category->image) }}" class="img-responsive uploadImage" style="width: 200px; height: 200px;"><br/><br>
                            <input type="file" id="image" name="image" class="uploadImageFile" required>
                        @if ($errors->has('image'))
                            <span class="help-block">
                              <strong>{{ $errors->first('image') }} </strong>
                            </span>
                        @endif
                    </div> --}}

                    <div class="form-group">
                        <label for="name">Category Name</label>
                        <x-input type="text" name="name" value="{{ $category->name }}" autocomplete="off"/>
                    </div>


	                <div class="form-group">
	                    <label>Transactioin Type <span class="text-red">*</span></label>
	                    <select name="type" class="form-control" id="type" style="width: 100%;">
	                        <option value="">Select Type</option>
	                        @foreach($types as $type)
	                        <option value="{{ $type->value }}" {{ ($category->type == $type->value) ? 'selected' : '' }}>{{ $type->name }}</option>
	                        @endforeach
	                    </select>
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
<script>
$(function(){
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

           reader.onload = function (e) {
                $('.uploadImage').attr('src', e.target.result);
            }
           reader.readAsDataURL(input.files[0]);
        }
    }

   $(".uploadImageFile").change(function(){
        readURL(this);
    });
});
</script>
@endpush

</x-app-layout>

