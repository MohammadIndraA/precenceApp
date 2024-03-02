@extends('frontend.index') @section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <div class="row">
                        <div class="col-6 d-flex align-items-center">
                            <h6>Kelas table</h6>
                        </div>
                        <div class="col-6 text-end">
                            <button class="btn btn-outline-primary btn-sm mb-0 tambah-kelas">Tambah</button>
                        </div>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th
                                        width="5px"
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-2">No</th>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">nama kelas</th>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Jurusan</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Created</th>
                                    <th class="text-secondary opacity-7"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kelas as $item)
                                <tr>
                                    <td>
                                        <div class="d-flex">
                                            <div class="d-flex flex-column justify-content-center">
                                                <p class="text-xs text-secondary mb-0">{{ $loop->iteration }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">
                                            {{ $item->nama_kelas }}</p>
                                        <p class="text-xs text-secondary mb-0">
                                            {{ $item->kode_kelas }}</p>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        <p class="text-xs text-secondary mb-0">
                                            {{ $item->jurusan }}</p>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-secondary text-xs font-weight-bold">{{ $item->created_at->diffForhumans() }}</span>
                                    </td>
                                    <td class="align-middle">
                                        <a
                                            href=""
                                            data-id="{{ $item->id }}"
                                            class="text-secondary font-weight-bold text-xs edit-kelas"
                                            data-toggle="tooltip"
                                            data-original-title="Edit user">
                                            Edit
                                        </a>
                                        |
                                        <a
                                            href=""
                                            data-id="{{ $item->id }}"
                                            class="text-secondary font-weight-bold text-xs hapus-kelas"
                                            data-toggle="tooltip"
                                            data-original-title="Hapus user">
                                            hapus
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div
    class="modal fade modal-kelas"
    id="exampleModal"
    tabindex="-1"
    aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1 >
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <form class="form-kelas">
                            @csrf
                            <div class="form-group">
                                <label for="">Nama Kelas</label>
                                <input
                                    type="text"
                                    name="nama_kelas"
                                    class="form-control nama_kelas"
                                    required="required"
                                    placeholder="Masukan Nama Kelas"></div>
                                <div class="form-group">
                                    <label for="">Jurusan</label>
                                    <input
                                        type="text"
                                        name="jurusan"
                                        class="form-control jurusan"
                                        required="required"
                                        placeholder="Masukan Nama Jurusan"></div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
@endsection

@push('js') <script> 

    $(function () {

    // tambah
    $('.tambah-kelas').click(function () {
        $('.modal-kelas').modal('show');
        $('input[name="nama_kelas"]').val();
        $('input[name="jurusa"]').val();
        $('.form-kelas').submit(function (e) {
            e.preventDefault();
            const token = localStorage.getItem('token');
            const form_data = new FormData(this);

            $.ajax({
                url: '/api/kelas/create',
                type: 'POST',
                data: form_data,
                cache: false,
                contentType: false,
                processData: false, // Perbaikan penulisan
                headers: { // Perbaikan penulisan
                    "Authorization": 'Bearer ' + token
                },
                success: function (data) {
                    if (data.message == 'success') {
                        alert('data berhasil ditambahkan');
                        location.reload();
                    }
                }
            });
        });
    });

    // edit

    $('.edit-kelas').click(function (e) {
        $('.modal-kelas').modal('show');
        e.preventDefault();
        const token = localStorage.getItem('token');
        const id = $(this).data('id');
        $.ajax({
            url: '/api/kelas/show/' + id,
            type: 'GET',
            headers: {
                'Authorization': 'Bearer ' + token // Sesuaikan dengan format penulisan token Anda
            },
            success: function (data) {
                // $('.password').remove();
                $('input[name="nama_kelas"]').val(data['kelas'][0].nama_kelas);
                $('.jurusan').val(data['kelas'][0].jurusan);
            },
            error: function (error) {
                console.error('Error:', error);
            }
        });

        $('.form-kelas').submit(function(e) {
              e.preventDefault();
              const token = localStorage.getItem('token');
              const form_data = new FormData(this);
              const csrf_token = $('meta[name="csrf-token"]').attr('content');
              form_data.append('_token', csrf_token);
              form_data.delete('_token');
              $.ajax({
                url : `api/kelas/update/${id}?_method=PUT`,
                type : 'POST',
                data : form_data,
                cache: false,
                      contentType: false,
                      processData: false, // Perbaikan penulisan
                      headers: { // Perbaikan penulisan
                        'Authorization': 'Bearer ' + token
                      },
                      success: function (data) {
                          if (data.message == 'success') {
                              alert('data berhasil di Update');
                              location.reload();
                          }
                      }
              });

        })

    });

        //   hapsu

        $(document).on('click', '.hapus-kelas', function (e) {
            const token = localStorage.getItem('token');
            const csrf_token = $('meta[name="csrf-token"]').attr('content');
            console.log(csrf_token);
            e.preventDefault();

            const id = $(this).data('id');
            const confirm_data = confirm('Apakah yakin hapus data?');
            if (confirm_data) {
                $.ajax({
                    url: '/api/kelas/delete/' + id,
                    type: 'DELETE',
                    data: {
                        _token: csrf_token, // Sertakan token CSRF dalam data permintaan
                    },
                    headers: {
                        'Authorization': 'Bearer ' + token,
                    },
                    success: function (data) {
                        if (data.message == 'success') {
                            location.reload();
                        }
                    }
                });
            }
        });

}) </script> @endpush