<x-app-layout title="Admin Management">
 
    <x-slot name="header">

    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="font-semibold text-xl text-gray-800 leading-tight">
               Admin Management
            </h1>
        </div>

        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Admin List</a></li>
                <li class="breadcrumb-item active">Admin Edit</li>
            </ol>
        </div>
    </div>

    </x-slot>

    <div class="row">
        <div class="col-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Edit Admin</h3>
                </div>
              <!-- /.card-header -->

                <!-- form start -->
                <form action="{{ route('users.update', $user) }}" method="POST">
                @csrf
                @method('PATCH')

                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <x-input type="text" name="name" value="{{ $user->name }}" autocomplete="off"/>
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <x-input type="text" name="email" value="{{ $user->email }}" autocomplete="off"/>
                    </div>

<!--                     <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Password">
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation">Password Confirmation</label>
                        <x-input type="password" name="password_confirmation" placeholder=""/>
                    </div> -->
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

