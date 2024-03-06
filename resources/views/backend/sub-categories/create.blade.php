<x-app-layout title="Category Management">
 
    <x-slot name="header">

    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="font-semibold text-xl text-gray-800 leading-tight">
               Sub-Category Management
            </h1>
        </div>

        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Sub-Category List</a></li>
                <li class="breadcrumb-item active">Sub-Category Create</li>
            </ol>
        </div>
    </div>

    </x-slot>

    <div class="row">
        <div class="col-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Create New Sub-Category</h3>
                </div>
              <!-- /.card-header -->

                <!-- form start -->
                <form action="{{ route('sub-categories.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="card-body">

                    <div class="form-group {{ $errors->has('logo') ? 'has-error' : '' }}">
                        <img for="logo" src="{{url('/img/no-image.png')}}" class="img-responsive uploadImage" style="width: 200px; height: 200px;"><br/><br>
                            <input type="file" id="image" name="image" class="uploadImageFile" required>
                        @if ($errors->has('image'))
                            <span class="help-block">
                              <strong>{{ $errors->first('image') }} </strong>
                            </span>
                        @endif
                    </div>

	                <div class="form-group">
	                    <label>Category <span class="text-red">*</span></label>
	                    <select name="category_id" class="form-control select2 category_id" id="category_id" style="width: 100%;">
                            <option>Select Category</option>
                            @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }} ({{$category->type->name}})</option>
                            @endforeach
	                        
	                    </select>
	                </div>

                    <div class="form-group">
                        <label for="name">Sub-Category Name <span class="text-red">*</span></label>
                        <x-input type="text" name="name" value="" autocomplete="off"/>
                    </div>

                    <x-input readonly type="hidden" name="type" id="type" value="" autocomplete="off"/>

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
$(document).on("change", ".category_id", function () {
    var category_id = $('#category_id').val();
    var url = '{{ route("ajax.get-category") }}';

    $.ajax({
        url: url,
        type : "POST",
        dataType: 'json',
        data: {
            "_token": "{{ csrf_token() }}",
            "category_id" : category_id,
        },
        success: function(response){
            $('#type').val(response);
        }
    })
});

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

