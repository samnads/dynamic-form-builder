@extends('layouts.admin')
@section('title', 'Forms List')
@section('content')
<table class="table table-bordered" id="formTable" class="display" url="{{ route('forms.datatable') }}">
    <thead>
        <tr>
            <th class="text-left">Sl. No.</th>
            <th>Title</th>
            <th>Public URL</th>
        </tr>
    </thead>
    <tbody>

    </tbody>
</table>
@endsection
@section('scripts')
<script src="{{ asset('js/list-forms.js?v=').time() }}"></script>
@endsection