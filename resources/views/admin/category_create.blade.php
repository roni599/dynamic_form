@extends('layouts.app')

@section('content')
    <div class="container max-w-7xl mx-auto px-4 py-4 sm:py-4 lg:px-8 sm:px-6 lg:px-8">
        <div class="card">
            <div class="card-header">
                Create Category
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <form action="{{ route('admin.category.store') }}" method="POST">
                            @csrf
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <div class="mb-3">
                                <label for="name" class="form-label">Category Name</label>
                                <input type="text" class="form-control w-100" id="name" name="name"
                                    placeholder="Enter category name">
                            </div>

                            <div class="mb-3">
                                <label for="user_name" class="form-label">User Name</label>
                                <input type="text" class="form-control w-100" id="user_name" name="user_name"
                                    placeholder="User Name" value="{{ $user->name }}" readonly>
                            </div>

                            <input type="hidden" name="user_id" value="{{ $user->id }}">

                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" id="description" name="description" placeholder="Enter description"></textarea>
                            </div>

                            <button type="submit" class="btn btn-primary w-100">Create</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
