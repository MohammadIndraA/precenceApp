@extends('frontend.index')@section('content') <div class = "container-fluid py-4" > <div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header pb-0">
                <div class="row">
                    <div class="col-6 d-flex align-items-center">
                        <h6>Account table</h6>
                    </div>
                    <div class="col-6 text-end">
                        <button class="btn btn-outline-primary btn-sm mb-0 tambah-akun">Tambah</button>
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
                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nisp</th>
                                <th
                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                                <th
                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Created</th>
                                <th class="text-secondary opacity-7"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($akun as $item)
                            <tr>
                                <td>
                                    <div class="d-flex">
                                        <div class="d-flex flex-column justify-content-center">
                                            <p class="text-xs text-secondary mb-0">{{ $loop->iteration }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <p class="text-xs text-secondary mb-0">
                                        {{ $item->nisp }}</p>
                                </td>
                                <td class="align-middle text-center text-sm">
                                    <span class="badge badge-sm bg-gradient-success">
                                        {{ $item->level }}</span>
                                </td>
                                <td class="align-middle text-center">
                                    <span class="text-secondary text-xs font-weight-bold">{{ $item->created_at->diffForhumans() }}</span>
                                </td>
                                <td class="align-middle">
                                    <a
                                        href="javascript:;"
                                        data-id="{{ $item->nisp }}"
                                        class="text-secondary font-weight-bold text-xs edit-akun"
                                        data-toggle="tooltip"
                                        data-original-title="Edit user">
                                        Edit
                                    </a>
                                    |
                                    <a
                                        href="javascript:;"
                                        data-id="{{ $item->nisp }}"
                                        class="text-secondary font-weight-bold text-xs hapus-akun"
                                        data-toggle="tooltip"
                                        data-original-title="Edit user">
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
</div> </div>
<div class="modal fade modal-akun" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1 > <button
    type="button"
    class="btn-close"
    data-bs-dismiss="modal"
    aria-label="Close"></button>
</div>
<div class="modal-body">
<div class="row">
    <div class="col-lg-12">
      @csrf
        <form class="form-akun">
          @csrf
            <div class="form-group">
                <label for="">Nisp</label>
                <input
                    type="text"
                    name="nisp"
                    class="form-control nisp"
                    required="required"
                    placeholder="Masukan Nis / Nip"></div>
                <div class="form-group">
                    <label for="">Level</label>
                    <select
                        class="form-select form-select-sm level"
                        name="level"
                        aria-label="Small select example">
                        <option selected="selected">Pilih Level</option>
                        <option value="Siswa">Siswa</option>
                        <option value="Guru">Guru</option>
                        <option value="Admin">Admin</option>
                    </select>
                </div>
                <div class="form-group">
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
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
    </form>
</div>
</div> 
</div>

@endsection
<!-- Modal -->

@push('js')
   <script>
     $(function(){


      // tambah
      $('.tambah-akun').click(function () {
              $('.modal-akun').modal('show');
              $('input[name="nisp"]').val();
              $('input[name="level"]').val();
              $('input[name="password"]').val();
              $('.form-akun').submit(function (e) {
                  e.preventDefault();
                  const token = localStorage.getItem('token');
                  const form_data = new FormData(this);

                  $.ajax({
                      url: '/api/akun/create',
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
          
      $('.edit-akun').click(function(e) {
              $('.modal-akun').modal('show');
              e.preventDefault();
              const token = localStorage.getItem('token');
              const nis = $(this).data('id');
              $.ajax({
                url: '/api/akun/show/' + nis,
                type: 'GET',
                headers: {
                  'Authorization': 'Bearer ' + token  // Sesuaikan dengan format penulisan token Anda
                },
                success: function (data) {
                $('.password').remove();
                $('input[name="nisp"]').val(data['akun'][0].nisp);
                $('.level').val(data['akun'][0].level);
              },
              error: function (error) {
                  console.error('Error:', error);
              }
          });

            $('.form-akun').submit(function(e) {
              e.preventDefault();
              const token = localStorage.getItem('token');
              const form_data = new FormData(this);
              $.ajax({
                url : `api/akun/update/${nis}?_method=PUT`,
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

    $(document).on('click', '.hapus-akun', function (e) {
            const token = localStorage.getItem('token');
            const csrf_token = $('meta[name="csrf-token"]').attr('content');
            console.log(csrf_token);
            e.preventDefault();

            const nis = $(this).data('id');
            const confirm_data = confirm('Apakah yakin hapus data?');
            if (confirm_data) {
                $.ajax({
                    url: '/api/akun/delete/' + nis,
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
   </script> @endpush