@extends('layout.main')
@section('title')Applications @endsection
@section('content')
<div class="content">
    <table id="application-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Theme</th>
                <th>Message</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>File Path</th>
                <th>Created at</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>
<script>
    $(document).ready(function () {
        $('#application-table').DataTable({
            serverSide: false,
            processing: true,
            ajax: {
                type: 'get',
                url: '/applications/data',
            },
            columns: [
                {'data': 'id'},
                {'data': 'theme'},
                {'data': 'message'},
                {'data': 'first_name'},
                {'data': 'last_name'},
                {'data': 'email'},
                {'data': 'file_path'},
                {'data': 'created_at'},
                {'data': 'status'},
            ],
            order: [[0, 'asc']]
        })
    })
</script>
@endsection
