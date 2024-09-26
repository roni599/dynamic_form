@extends('layouts.app')

@section('content')
    <div class="container max-w-7xl mx-auto px-4 py-4 sm:py-4 lg:px-8 sm:px-6 lg:px-8">
        <div class="card">
            <div class="card-header">
                <h2>Edit Form Template</h2>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.formtemplate.update', $formtemplate->id) }}" method="POST">
                    @csrf
                    @method('PUT')

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
                        <label for="name" class="form-label">Template Title</label>
                        <input type="text" class="form-control w-100" id="name" name="title"
                            placeholder="Enter Template title" value="{{ old('name', $formtemplate->title) }}" required>
                    </div>
                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                    <div class="mb-3">
                        <label for="category" class="form-label">Select Category</label>
                        <select class="form-select" id="category" name="category_id" required>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="category" class="form-label">Select Category Status</label>
                        <select class="form-select" id="category" name="status">
                            <option value="1" {{ $formtemplate->status == 1 ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ $formtemplate->status == 0 ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" placeholder="Enter Form Template description">{{ old('description', $formtemplate->description) }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Update</button>
                </form>
            </div>
        </div>
    </div>
@endsection
