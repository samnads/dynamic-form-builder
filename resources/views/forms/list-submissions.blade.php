@extends('layouts.admin')
@section('title', 'Forms Submissions')
@section('content')
<table class="table table-bordered" id="formTable" class="display" url="{{ route('forms.submissions-datatable') }}">
    <thead>
        <tr>
            <th class="text-left">Sl. No.</th>
            <th>Form Title</th>
            <th>Data</th>
        </tr>
    </thead>
    <tbody>

    </tbody>
</table>
@endsection
@section('scripts')
<script src="{{ asset('js/list-submissions.js?v=').time() }}"></script>
@endsection