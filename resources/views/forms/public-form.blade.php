@extends('layouts.public')
@section('title', $form->title)
@section('content')
<div class="container mt-4">
    <form action="{{ route('form.save',['id'=>$form->id]) }}" method="POST" id="public-form">
        @csrf
        <div class="card text-dark bg-light mb-3 repeater">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span>{{ $form->title }}</span>
            </div>
            <div class="card-body" data-repeater-list="fields">
                @foreach($form->fields as $field)
                <div class="row mb-3">
                    <label for="colFormLabel" class="col-sm-2 col-form-label">{{ $field->label }}</label>
                    <div class="col-sm-10">
                        @if($field->fieldType->type == 'text')
                        <input type="text" class="form-control" name="names[{{ $field->id }}]" required>
                        @elseif($field->fieldType->type == 'number')
                        <input type="number" class="form-control" name="names[{{ $field->id }}]" required>
                        @elseif($field->fieldType->type == 'select')
                        <select class="form-select" name="names[{{ $field->id }}]" required>
                            <option value="">-- Select Option --</option>
                            @foreach(json_decode($field->data, true) as $data)
                            <option value="{{ $data }}">{{$data}}</option>
                            @endforeach
                        </select>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="text-end">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>
@endsection
@section('scripts')
<script src="{{ asset('js/public-form.js?v=').time() }}"></script>
@endsection