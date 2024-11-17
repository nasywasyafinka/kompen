<form action="{{ url('/kompetensi/ajax') }}" method="POST" id="form-tambah">
    @csrf
    <div id="modal-master" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Kompetensi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Jenis Kompetensi</label>
                    <select name="jenis_id" id="jenis_id" class="form-control" required>
                        <option value="">- Pilih Jenis -</option>
                        @foreach($jenis as $j)
                            <option value="{{ $j->jenis_id }}">{{ $j->jenis_nama }}</option>
                        @endforeach
                    </select>
                    <small id="error-jenis_id" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label>Kode</label>
                    <input value="" type="text" name="kompetensi_kode" id="kompetensi_kode" class="form-control" required>
                    <small id="error-kompetensi_kode" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label>Nama</label>
                    <input value="" type="text" name="kompetensi_nama" id="kompetensi_nama" class="form-control" required>
                    <small id="error-kompetensi_nama" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label>Deskripsi</label>
                    <input value="" type="text" name="kompetensi_deskripsi" id="kompetensi_deskripsi" class="form-control" required>
                    <small id="error-kompetensi_deskripsi" class="error-text form-text text-danger"></small>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-warning">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</form>
<script>
    $(document).ready(function() {
        $("#form-tambah").validate({
            rules: {
                jenis_id: {required: true, number: true},
                kompetensi_kode: {required: true, minlength: 3, maxlength: 20},
                kompetensi_nama: {required: true, minlength: 3, maxlength: 100},
                kompetensi_deskripsi: {required: true, minlength: 10, maxlength: 500}
            },
            submitHandler: function(form) {
                $.ajax({
                    url: form.action,
                    type: form.method,
                    data: $(form).serialize(),
                    success: function(response) {
                        if(response.status){
                            $('#myModal').modal('hide');
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: response.message
                            });
                            dataKompetensi.ajax.reload();
                        }else{
                            $('.error-text').text('');
                            $.each(response.msgField, function(prefix, val) {
                                $('#error-'+prefix).text(val[0]);
                            });
                            Swal.fire({
                                icon: 'error',
                                title: 'Terjadi Kesalahan',
                                text: response.message
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("Status: " + status);
                        console.error("Error: " + error);
                        console.error("Response: " + xhr.responseText);
                        Swal.fire({
                            icon: 'error',
                            title: 'Terjadi Kesalahan',
                            text: 'Gagal mengirim data.'
                        });
                    }
                });
                return false;
            },
            errorElement: 'span',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });
    });
</script>