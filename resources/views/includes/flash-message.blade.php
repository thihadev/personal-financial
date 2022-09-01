@if ($message = session('success'))
    <div class="alert alert-success alert-dismissable">
        <button type="button" class="close" data-dismiss="alert">×</button>    
        <strong>{{ $message }}</strong>
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger alert-dismissable">
        <button type="button" class="close" data-dismiss="alert">×</button>    
        Please check the form below for errors.

        @foreach ($errors->all() as $message)
            <li>{{ $message }}</li>
        @endforeach
    </div>
@endif
