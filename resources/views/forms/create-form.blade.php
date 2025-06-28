@extends('layouts.admin')
@section('title', 'New Form')
@section('content')
<h3 class="mb-4">Create New Form</h3>
<div class="container mt-4">
    <form action="{{ route('forms.save') }}" method="POST" id="new-form">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Form Title</label>
            <input type="text" class="form-control" id="title" placeholder="Enter title for the form..." name="title">
        </div>

        <div class="card text-dark bg-light mb-3 repeater">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span>Form Fields</span>
            </div>
            <div class="card-body" data-repeater-list="fields">
                <div class="row mb-2 repeater-item" data-repeater-item>
                    <div class="col-1 d-flex align-items-center">
                        <i class="fas fa-circle"></i>
                    </div>
                    <div class="col">
                        <select class="form-select field_type" name="fields[][field_type]">
                            <option value="">-- Select Field Type --</option>
                            @foreach($field_types as $field_type)
                            <option value="{{ $field_type->id }}" data-type="{{ $field_type->type }}">{{
                                $field_type->name
                                }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" placeholder="Enter label for the field..."
                            name="fields[][label]">
                    </div>
                    <div class="col">
                        <input type="text" class="form-control data" placeholder="Type and add options..."
                            name="fields[][data]" disabled>
                    </div>
                    <div class="col-1 d-flex align-items-center">
                        <span data-repeater-delete title="Remove" role="button">
                            <i class="fas fa-trash text-danger"></i></span>
                    </div>
                </div>
            </div>
            <div class="card-footer d-flex justify-content-between align-items-center">
                <button data-repeater-create class="btn btn-sm btn-success" type="button" data-action="add-field">
                    <i class="fas fa-plus"></i> Add Field
                </button>
            </div>
        </div>
        <div class="text-end">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>
@endsection
@section('scripts')
<script src="{{ asset('js/create-form.js?v=').time() }}"></script>
@endsection