@extends('frontend.index')
@section('content') <div class = "container-fluid py-4" > <div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header pb-0">
              <div class="row">
                <div class="col-6 d-flex align-items-center">
                  <h6>Siswa table</h6>
                  </div>
                  <div class="col-6 text-end">
                    <button class="btn btn-outline-primary btn-sm mb-0 tambah-siswa">Tambah</button>
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
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name</th>
                               
                                <th
                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nisp</th>
                                    <th
                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Name Ortu</th>
                                <th
                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Alamat</th>
                                <th
                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Created</th>
                                <th class="text-secondary opacity-7"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($user as $item)
                            <tr>
                                <td>
                                    <div class="d-flex">
                                        <div class="d-flex flex-column justify-content-center">
                                            <input type="hidden" class="id" value="{{ $item->id }}">
                                                <p class="text-xs text-secondary mb-0">{{ $loop->iteration }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div></div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">
                                                    {{ $item->nama_lengkap }}</h6>
                                                <p class="text-xs text-secondary mb-0">j{{ $item->no_telepon }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">
                                                    {{ $item->nis }}</h6>
                                            </div>
                                        </div>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">
                                                {{ $item->nama_ortu }}</p>
                                            <p class="text-xs text-secondary mb-0">
                                                {{ $item->no_telepon_ortu }}</p>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <p class="text-xs text-secondary mb-0">
                                                {{ $item->alamat_lengkap }}</p>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span class="text-secondary text-xs font-weight-bold">{{ $item->created_at->diffForhumans() }}</span>
                                        </td>
                                        <td class="align-middle">
                                            <a
                                                href=""
                                                data-id="{{ $item->nis }}"
                                                class="text-secondary font-weight-bold text-xs edit-siswa"
                                                data-toggle="tooltip"
                                                data-original-title="Edit user">
                                                Edit
                                            </a>
                                            |
                                            <a
                                                href=""
                                                data-id="{{ $item->nis }}"
                                                class="text-secondary font-weight-bold text-xs hapus-siswa"
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
    </div>
    <!-- Modal -->
    <div
        class="modal fade modal-form"
        id="exampleModal"
        tabindex="-1"
        aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <div class="row">
                  <div class="col-lg-12">
                    <form class="form-siswa">
                      @csrf
                      <input type="hidden" class="id" value="">
                      <div class="form-group">
                        <label for="">Nama Siswa</label>
                        <input type="text" name="nama_lengkap" class="form-control" placeholder="Nama Siswa" required>
                      </div>
                      <div class="form-group">
                        <label for="">Nis</label>
                        <input type="text" name="nis" class="form-control" placeholder="Nis Siswa" required>
                      </div>
                      <div class="form-group">
                        <label for="">Nama Orang tua</label>
                        <input type="text" name="nama_ortu" class="form-control" placeholder="Nama  Orang tua" required>
                      </div>
                      <div class="form-group">
                        <label for="">Alamat</label>
                        <input type="text" name="alamat_lengkap" class="form-control" placeholder="Alamat Siswa" required>
                      </div>
                      <div class="row">
                        <div class="col-lg-6">
                          <div class="form-group">
                            <label for="">No telepon siswa</label>
                            <input type="number" name="no_telepon" class="form-control" placeholder="telepon Siswa" required>
                          </div>
                        </div>
                        <div class="col-lg-6">
                          <div class="form-group">
                            <label for="">No telepon Orang Tua</label>
                            <input type="text" name="no_telepon_ortu" class="form-control" placeholder="No telepon Orang Tua" required>
                          </div>
                        </div>
                      </div> 
                      <div class="form-group password">
                        <label for="">Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Password Siswa" required>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="sumbit" class="btn btn-primary">Save changes</button>
                </div>
              </form>
            </div>
        </div>
    </div>
    @endsection @push('js')
    <script>
        $(function () {
          $(document).on('click', '.hapus-siswa', function () {
              const token = localStorage.getItem('token');
                const nis = $(this).data('id');
                confirm_data = confirm('Apakah yakin hapus data?');
                if (confirm_data) {
                    $.ajax({
                        url: '/api/user/delete' + nis,
                        type: 'DELETE',
                        header: {
                            "Authorization": token
                        },
                        success: function (data) {
                            if (data.message == 'success') {
                                location.reload();
                            }
                        }
                    })
                }
            })

            $('.tambah-siswa').click(function () {
              $('.modal-form').modal('show');
              $('input[name="nama_lengkap"]').val();
              $('input[name="nama_ortu"]').val();
              $('input[name="nis"]').val();
              $('input[name="no_telepon"]').val();
              $('input[name="alamat"]').val();
              $('input[name="no_telepon_ortu"]').val();
              $('.form-siswa').submit(function (e) {
                  e.preventDefault();
                  const token = localStorage.getItem('token');
                  const form_data = new FormData(this);

                  $.ajax({
                      url: '/api/register',
                      type: 'POST',
                      data: form_data,
                      cache: false,
                      contentType: false,
                      processData: false, // Perbaikan penulisan
                      headers: { // Perbaikan penulisan
                          "Authorization": token
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
            $('.edit-siswa').click(function(e) {
              $('.modal-form').modal('show');
              e.preventDefault();
              const token = localStorage.getItem('token');
              const nis = $(this).data('id');
              $.ajax({
                url: '/api/user/' + nis,
                type: 'GET',
                headers: {
                  'Authorization': 'Bearer ' + token  // Sesuaikan dengan format penulisan token Anda
                },
                success: function (data) {
                $('.password').remove();
                $('input[name="nama_lengkap"]').val(data['user'].nama_lengkap);
                $('input[name="nama_ortu"]').val(data['user'].nama_ortu);
                $('input[name="nis"]').val(data['user'].nis);
                $('input[name="alamat_lengkap"]').val(data['user'].alamat_lengkap);
                $('input[name="no_telepon"]').val(data['user'].no_telepon);
                $('input[name="no_telepon_ortu"]').val(data['user'].no_telepon_ortu);
              },
              error: function (error) {
                  console.error('Error:', error);
              }
          });

            $('.form-siswa').submit(function(e) {
              e.preventDefault();
              const token = localStorage.getItem('token');
              const form_data = new FormData(this);
              $.ajax({
                url : `api/user/update/${nis}?_method=PUT`,
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

          // hapus
          $(document).on('click', '.hapus-siswa', function (e) {
            const token = localStorage.getItem('token');
            const csrf_token = $('meta[name="csrf-token"]').attr('content');
            console.log(csrf_token);
            e.preventDefault();

            const nis = $(this).data('id');
            const confirm_data = confirm('Apakah yakin hapus data?');
            if (confirm_data) {
                $.ajax({
                    url: '/api/user/delete/' + nis,
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

        });
    </script>
    @endpush