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
                        <form action="{{ route('admin.formtemplate.store') }}" method="POST">
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
                                <label for="name" class="form-label">Template Title</label>
                                <input type="text" class="form-control w-100" id="title" name="title"
                                    placeholder="Enter Form Template Name">
                            </div>
                            <div class="mb-3">
                                <label for="category" class="form-label">Select Category</label>
                                <select class="form-select" id="category" name="category_id" required>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="user_name" class="form-label">User Name</label>
                                <input type="text" class="form-control w-100" id="user_name" name="user_name"
                                    placeholder="User Name" value="{{ $user->name }}" readonly>
                            </div>

                            <input type="hidden" name="user_id" value="{{ $user->id }}">
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" id="description" name="description" placeholder="Enter Form description"></textarea>
                            </div>

                            <div id="fields-container" class="mb-3">
                            </div>
                            <button type="button" class="btn btn-success mb-3" id="add-field">Add Form Field</button>
                            <button type="submit" class="btn btn-primary w-100">Create</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('add-field').addEventListener('click', function() {
            const fieldHtml = `
                <div class="form-group mb-3">
                    <label>Field Label</label>
                    <input type="text" class="form-control" name="field_label[]" placeholder="Field label" required>
    
                    <label>Field Type</label>
                    <select class="form-select" name="field_type[]">
                        <option value="text">Text</option>
                        <option value="textarea">Textarea</option>
                        <option value="checkbox">Checkbox</option>
                        <option value="radio">Radio</option>
                        <option value="file">File</option>
                        <option value="date">Date</option>
                    </select>
                    <button type="button" class="btn btn-danger mt-2 remove-field">Remove</button>
                </div>
            `;
            const fieldsContainer = document.getElementById('fields-container');
            fieldsContainer.insertAdjacentHTML('beforeend', fieldHtml);
        });
        
        document.getElementById('fields-container').addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-field')) {
                e.target.closest('.form-group').remove();
            }
        });
    </script>
@endsection
