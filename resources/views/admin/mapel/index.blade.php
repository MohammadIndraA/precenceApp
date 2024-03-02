@extends('frontend.index')@section('content') <div class = "container-fluid py-4" > <div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header pb-0">
                <div class="row">
                    <div class="col-6 d-flex align-items-center">
                        <h6>Account table</h6>
                    </div>
                    <div class="col-6 text-end">
                        <button class="btn btn-outline-primary btn-sm mb-0 tambah-mapel">Tambah</button>
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
                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Kode Pelajaran</th>
                                <th
                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Mata Pelajaran</th>
                                <th
                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Hari</th>
                                <th
                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jam</th>
                                <th class="text-secondary opacity-7"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($mapel as $item)
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
                                        {{ $item->kode_pelajaran }}</p>
                                </td>
                                <td class="align-middle text-center text-sm">
                                    <span class="badge badge-sm bg-gradient-success">
                                        {{ $item->mata_pelajaran }}</span>
                                </td>
                                <td>
                                    <p class="text-xs text-secondary mb-0">
                                        {{ $item->hari }}</p>
                                </td>
                                <td class="align-middle text-center text-sm">
                                    <span class="badge badge-sm bg-gradient-success">
                                        {{ $item->jam }}</span>
                                </td>
                                <td class="align-middle">
                                    <a
                                        href="javascript:;"
                                        data-id="{{ $item->id }}"
                                        class="text-secondary font-weight-bold text-xs edit-mapel"
                                        data-toggle="tooltip"
                                        data-original-title="Edit user">
                                        Edit
                                    </a>
                                    |
                                    <a
                                        href="javascript:;"
                                        data-id="{{ $item->id }}"
                                        class="text-secondary font-weight-bold text-xs hapus-mapel"
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
<div class="modal fade modal-mapel" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
        <form class="form-mapel">
          @csrf
            <div class="form-group">
                <label for="">Mata Pelajaran</label>
                <input
                    type="text"
                    name="mata_pelajaran"
                    class="form-control mata_pelajaran"
                    required="required"
                    placeholder="Masukan Mata Pelajaran"></div>
               <div class="row">
                    <div col-lg-6>
                    <div class="form-group">
                        <label for="">Hari</label>
                        <select
                            class="form-select form-select-sm hari"
                            name="hari"
                            aria-label="Small select example">
                            <option selected="selected">Pilih Hari</option>
                            <option value="Senin">Senin</option>
                            <option value="Rabu">Rabu</option>
                            <option value="Kamis">Kamis</option>
                            <option value="Jumat">Jumat</option>
                            <option value="Sabtu">Sabtu</option>
                        </select>
                    </div>
                </div>
                    <div col-lg-6>
                    <div class="form-group">
                        <label for="">Jam</label>
                        <input
                            type="time"
                            name="jam"
                            class="form-control jam"
                            required="required"
                            placeholder="Masukan jam"></div>
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

@endsection
<!-- Modal -->

@push('js')
   <script>
     $(function(){


      // tambah
      $('.tambah-mapel').click(function () {
              $('.modal-mapel').modal('show');
              $('input[name="mata_pelajaran"]').val();
              $('input[name="hari"]').val();
              $('input[name="jam"]').val();
              $('.form-mapel').submit(function (e) {
                  e.preventDefault();
                  const token = localStorage.getItem('token');
                  const form_data = new FormData(this);

                  $.ajax({
                      url: '/api/mapel/create',
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
          
      $('.edit-mapel').click(function(e) {
              $('.modal-mapel').modal('show');
              e.preventDefault();
              const token = localStorage.getItem('token');
              const id = $(this).data('id');
              $.ajax({
                url: '/api/mapel/show/' + id,
                type: 'GET',
                headers: {
                  'Authorization': 'Bearer ' + token  // Sesuaikan dengan format penulisan token Anda
                },
                success: function (data) {
                    $('input[name="mata_pelajaran"]').val(data['mata_pelajaran'][0].mata_pelajaran);
                    $('.hari').val(data['mata_pelajaran'][0].hari);
                    $('.jam').val(data['mata_pelajaran'][0].jam);
              },
              error: function (error) {
                  console.error('Error:', error);
              }
          });

            $('.form-mapel').submit(function(e) {
              e.preventDefault();
              const token = localStorage.getItem('token');
              const form_data = new FormData(this);
              $.ajax({
                url : `api/mapel/update/${id}?_method=PUT`,
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

          //   hapsu

          $(document).on('click', '.hapus-mapel', function (e) {
            const token = localStorage.getItem('token');
            const csrf_token = $('meta[name="csrf-token"]').attr('content');
            console.log(csrf_token);
            e.preventDefault();

            const id = $(this).data('id');
            const confirm_data = confirm('Apakah yakin hapus data?');
            if (confirm_data) {
                $.ajax({
                    url: '/api/mapel/delete/' + id,
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