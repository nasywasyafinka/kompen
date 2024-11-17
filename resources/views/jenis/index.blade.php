@extends('layouts.template')

@section('content')

<div class="card card-outline card-primary">
<div class="hero">
    <h1>Jenis Tugas</h1>
</div>
<div class="notif">
    <h2>Jenis Tugas</h2>
</div>
<div class="content">
    <a class="add-task"  onclick="modalAction('{{ url('/jenis/create_ajax') }}')">
        + Tambah Jenis Tugas
    </a>

    @foreach ($jenis as $item)
    <div class="jenis-card">
        <img alt="Profile picture of {{ $item->jenis_nama }}" height="50" src="{{ $item->image_url }}" width="50"/>
        <div class="jenis-info">
            <h3>{{ $item->jenis_nama }}</h3>
            <p>{{ $item->jenis_deskripsi }}</p>
        </div>
        <div class="jenis-actions">
            <button class="edit-btn" onclick="modalAction('{{ url('/jenis/' . $item->jenis_id . '/edit_ajax') }}')">Edit</button>
            <button class="delete-btn" onclick="modalAction('{{ url('/jenis/' . $item->jenis_id . '/delete_ajax') }}')">Delete</button>
        </div>
    </div>
    @endforeach
</div>
</div>

<div id="myModal" class="modal fade animate shake" tabindex="-1" role="dialog" databackdrop="static" data-keyboard="false" data-width="75%" aria-hidden="true"></div>

@endsection

@push('js')
    <script>
        function modalAction(url = '') {
            $('#myModal').load(url, function() {
                $('#myModal').modal('show');
            });
        }
    </script>
@endpush