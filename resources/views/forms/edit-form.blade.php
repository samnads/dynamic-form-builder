@extends('layouts.admin')
@section('title', 'Edit Form')
@section('content')
<h3 class="mb-4">Edit Form</h3>
<div class="container mt-4">
    <form action="{{ route('forms.update',['id'=>$form['id']]) }}" method="POST" id="new-form">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Form Title</label>
            <input value="{{ $form['title'] }}" type="text" class="form-control" id="title"
                placeholder="Enter title for the form..." name="title">
        </div>

        <div class="card text-dark bg-light mb-3 repeater">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span>Form Fields</span>
            </div>
            <div class="card-body" data-repeater-list="fields">
                @foreach($form['fields'] as $key => $field)
                <div class="row mb-2 repeater-item" data-repeater-item>
                    <input type="hidden" name="fields[{{  $key }}][id]" value="{{ $field['id'] }}" />
                    <div class="col-1 d-flex align-items-center">
                        <i class="fas fa-circle"></i>
                    </div>
                    <div class="col">
                        <select class="form-select field_type" name="fields[][field_type]">
                            <option value="">-- Select Field Type --</option>
                            @foreach($field_types as $field_type)
                            <option value="{{ $field_type->id }}" data-type="{{ $field_type->type }}" {{
                                $field['field_type_id']==$field_type->id ? 'selected' : ''}}>{{
                                $field_type->name
                                }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" placeholder="Enter label for the field..."
                            name="fields[][label]" value="{{  $field['label'] }}">
                    </div>
                    <div class="col">
                        <input value="{{ implode(', ', json_decode($field['data'])) }}" type="text"
                            class="form-control data" placeholder="Type and add options..." name="fields[][data]"
                            disabled>
                    </div>
                    <div class="col-1 d-flex align-items-center">
                        <span data-repeater-delete title="Remove" role="button">
                            <i class="fas fa-trash text-danger"></i></span>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="card-footer d-flex justify-content-between align-items-center">
                <button data-repeater-create class="btn btn-sm btn-success" type="button" data-action="add-field">
                    <i class="fas fa-plus"></i> Add Field
                </button>
            </div>
        </div>
        <div class="text-end">
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </form>
</div>
@endsection
@section('scripts')
<script src="{{ asset('js/edit-form.js?v=').time() }}"></script>
@endsection