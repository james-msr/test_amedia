@extends('layout.main')
@section('title')Applications @endsection
@section('content')
<div class="container">
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
        var csrf = $('meta[name="csrf_token"]').attr('content');
        $('#application-table').DataTable({
            serverSide: false,
            processing: true,
            ajax: {
                type: 'get',
                url: '/applications/data',
            },
            columns: [
                { data: 'id'},
                { data: 'theme'},
                { data: 'message'},
                { data: 'first_name'},
                { data: 'last_name'},
                { data: 'email'},
                { data: 'file_path'},
                { data: 'created_at'},
                {
                    data: 'status',
                    render: function (data, type) {
                        if (type === 'display') {
                            if (data === 'Checked') {
                                return '<input type="button" class="btn btn-success" value="' + data + '">'
                            }
                            return '<input type="button" class="btn btn-danger" value="' + data + '">'
                        }
                        return data;
                    }
                },
            ],
            order: [[0, 'asc']]
        });

        $(document).on('click', '.btn-danger', function () {
            if ($(this).val() === 'Not checked') {
                var id = $(this).parent().parent().find('td:first-child').text()
                $.ajax({
                    type: 'post',
                    url: '/application/check',
                    headers: {
                        'X-CSRF-TOKEN': csrf
                    },
                    data: {
                        'id': id
                    },
                    success: function (response) {
                        if (response['success']) {
                            $('.btn-danger').removeClass('btn-danger')
                                            .addClass('btn-success')
                                            .val('Checked')
                        }
                    },
                    error: function (error) {
                        console.log(error)
                    }
                })
            }
        })
    });
</script>
@endsection
