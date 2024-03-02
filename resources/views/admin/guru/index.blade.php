@extends('frontend.index')
@section('content') <div class = "container-fluid py-4" > <div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header pb-0">
              <div class="row">
                <div class="col-6 d-flex align-items-center">
                    <h6>Guru table</h6>
                </div>
                <div class="col-6 text-end">
                    <button class="btn btn-outline-primary btn-sm mb-0 tambah-guru">Tambah</button>
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
                                    width="5px"
                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-2">Kode</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name</th>
                                <th
                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">No Whatsapp</th>
                                <th
                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Alamat</th>
                                <th
                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Created</th>
                                <th class="text-secondary opacity-7"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($guru as $item)
                            <tr>
                                <td>
                                    <div class="d-flex">
                                        <div class="d-flex flex-column justify-content-center">
                                            <p class="text-xs text-secondary mb-0">{{ $loop->iteration }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex px-2 py-1">
                                        <div class="d-flex flex-column justify-content-center">
                                            <p class="text-xs text-secondary mb-0">{{ $item->kode_guru }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex px-2 py-1">
                                        <div></div>
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm">
                                                {{ $item->nama_guru }}</h6>
                                            <p class="text-xs text-secondary mb-0">{{ $item->nip }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex px-2 py-1">
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm">
                                                {{ $item->no_whatsapp }}</h6>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex px-2 py-1">
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm">
                                                {{ $item->alamat_lengkap }}</h6>
                                        </div>
                                    </div>
                                </td>
                                <td class="align-middle text-center">
                                    <span class="text-secondary text-xs font-weight-bold">{{ $item->created_at->diffForhumans() }}</span>
                                </td>
                                <td class="align-middle">
                                    <a
                                        href=""
                                        data-id="{{ $item->nip }}"
                                        class="text-secondary font-weight-bold text-xs edit-guru"
                                        data-toggle="tooltip"
                                        data-original-title="Edit user">
                                        Edit
                                    </a>
                                    |
                                    <a
                                        href=""
                                        data-id="{{ $item->nip }}"
                                        class="text-secondary font-weight-bold text-xs hapus-guru"
                                        data-toggle="tooltip"
                                        data-original-title="Edit user">
                                        Hapus
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
<div
    class="modal fade modal-guru"
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
                        @csrf
                        <form class="form-guru">
                            @csrf
                            <div class="form-group">
                                <label for="">Nisp</label>
                                <input
                                    type="text"
                                    name="nip"
                                    class="form-control nisp"
                                    required="required"
                                    placeholder="Masukan Nis / Nip"></div>
                                <div class="form-group">
                                   <label for="">Nama Guru</label>
                                  <input
                                    type="text"
                                    name="nama_guru"
                                    class="form-control nama_guru"
                                    required="required"
                                    placeholder="Masukan Nama Guru"></div>
                                <div class="form-group">
                                   <label for="">Alamat Lengkap</label>
                                  <input
                                    type="text"
                                    name="alamat_lengkap"
                                    class="form-control alamat_lengkap"
                                    required="required"
                                    placeholder="Masukan Alamat Lengkap"></div>
                                    <div class="row">
                                      <div class="col-lg-6">
                                        <div class="form-group">
                                          <label for="">No whatsapp</label>
                                         <input
                                           type="text"
                                           name="no_whatsapp"
                                           class="form-control no_whatsapp"
                                           required="required"
                                           placeholder="Masukan No whatsapp"></div>
                                          </div>
                                           <div class="col-lg-6">
                                            <div class="form-group password">
                                              <label for="">Password</label>
                                              <input
                                                  type="password"
                                                  name="password"
                                                  class="form-control password"
                                                  required="required"
                                                  placeholder="Masukan Password"></div>
                                      </div>
                                    </div>
                               
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
        </div>
        @endsection @push('js')
        <script>
            $(function () {

                // tambah
                $('.tambah-guru').click(function () {
                    $('.modal-guru').modal('show');
                    $('input[name="nip"]').val();
                    $('input[name="nama_guru"]').val();
                    $('input[name="no_whatsapp"]').val();
                    $('input[name="alamat_lengkap"]').val();
                    $('input[name="password"]').val();
                    $('.form-guru').submit(function (e) {
                        e.preventDefault();
                        const token = localStorage.getItem('token');
                        const form_data = new FormData(this);

                        $.ajax({
                            url: '/api/guru/create',
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

                $('.edit-guru').click(function (e) {
                    $('.modal-guru').modal('show');
                    e.preventDefault();
                    const token = localStorage.getItem('token');
                    const nip = $(this).data('id');
                    $.ajax({
                        url: '/api/guru/showGuru/' + nip,
                        type: 'GET',
                        headers: {
                            'Authorization': 'Bearer ' + token // Sesuaikan dengan format penulisan token Anda
                        },
                        success: function (data) {
                            $('.password').remove();
                            $('input[name="nip"]').val(data.guru.nip);
                          $('input[name="nama_guru"]').val(data.guru.nama_guru);
                          $('input[name="no_whatsapp"]').val(data.guru.no_whatsapp);
                          $('input[name="alamat_lengkap"]').val(data.guru.alamat_lengkap);
                        },
                        error: function (error) {
                            console.error('Error:', error);
                        }
                    });

                    $('.form-guru').submit(function (e) {
                        e.preventDefault();
                        const token = localStorage.getItem('token');
                        const form_data = new FormData(this);
                        $.ajax({
                            url: `api/guru/update/${nip}?_method=PUT`,
                            type: 'POST',
                            data: form_data,
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

                $(document).on('click', '.hapus-guru', function (e) {
            const token = localStorage.getItem('token');
            const csrf_token = $('meta[name="csrf-token"]').attr('content');
            console.log(csrf_token);
            e.preventDefault();

            const nip = $(this).data('id');
            const confirm_data = confirm('Apakah yakin hapus data?');
            if (confirm_data) {
                $.ajax({
                    url: '/api/guru/delete/' + nip,
                    type: 'DELETE',
                    data: {
                        _token: csrf_token, // Sertakan token CSRF dalam data permintaan
                    },
                    headers: {
                        'Authorization': 'Bearer ' + token,
                    },
                    success: function (data) {
                        if (data.message == 'success') {
                            alert('data berhasil di Hapus');
                            location.reload();
                        }
                    }
                });
            }
        });  
            })
        </script>
        @endpush