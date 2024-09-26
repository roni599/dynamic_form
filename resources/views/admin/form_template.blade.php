@extends('layouts.app')
@section('content')
    <div class="container max-w-7xl mx-auto px-4 py-4 sm:py-4 lg:px-8 sm:px-6 lg:px-8">
        <div class="card">
            <div class="card-header d-flex justify-between align-items-center">
                <div class="tableheader">
                    Form Template Table
                </div>
                <div class="buttonheader">
                    <a href="{{ route('admin.formtemplate.create') }}" class="btn btn-sm btn-primary">Create New Form
                        Template</a>
                </div>
            </div>
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Category</th>
                            <th>status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($formtemplates as $index => $formTemplate)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $formTemplate->title }}</td>
                                <td>{{ $formTemplate->description }}</td>
                                <td>{{ $formTemplate->category->name }}</td>
                                <td>
                                    {{ $formTemplate->status == 1 ? 'Active' : 'Inactive' }}
                                </td>

                                <td>
                                    <a href="{{ route('admin.formtemplate.edit',$formTemplate->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('admin.formtemplate.delete',$formTemplate->id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm"
                                            onclick="return confirm('Are you sure you want to delete this category?')">Delete</button>
                                    </form>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
