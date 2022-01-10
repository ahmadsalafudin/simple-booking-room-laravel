<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Booking Room</title>
        <link rel="stylesheet" href="{{url('')}}/assets/css/style.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    </head>
    <div class="container">
        @if(session('sukses'))
            <div class="alert alert-success alert-with-icon fade show" data-notify="container">
                <button type="button" aria-hidden="true" class="close" data-dismiss="alert" aria-label="Close">
                    <i class="nc-icon nc-simple-remove"></i>
                </button>
                <span data-notify="icon" class="nc-icon nc-bell-55"></span>
                <span data-notify="message">{{session('sukses')}}</span>
            </div>
        @elseif(session('error'))
            <div class="alert alert-danger alert-with-icon fade show" data-notify="container">
                <button type="button" aria-hidden="true" class="close" data-dismiss="alert" aria-label="Close">
                    <i class="nc-icon nc-simple-remove"></i>
                </button>
                <span data-notify="icon" class="nc-icon nc-bell-55"></span>
                <span data-notify="message">{{session('error')}}</span>
            </div>
        @endif
        <div class="row">
            <div class="col-md-12 mb-4 text-center">
                <h5>Booking Room</h5>
                <p>Silahkan pilih ruangan yang masih kosong untuk booking ruangan baru</p>
                <div onclick="cancelAll()">
                    <div class="text-danger"><i class="bi bi-trash-fill"></i></div>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach ($data as $row)
                <div class="col-lg-3 text-center my-2">
                    @if ($row->status == 'isi')
                        <div class="cards"  onclick="details({{$row->id}})">
                            <p><b>{{$row->name}}</b></p>
                        </div>
                        <div class="cancel" onclick="cancel({{$row->id}})">
                            <div class="text-danger"><i class="bi bi-trash-fill"></i></div>
                        </div>
                    @else
                        <div class="cards-2" onclick="book({{$row->id}})">
                            <p>{{$row->name}}</p>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
    <div class="modal fade" id="modal-detail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header"> <h5 class="modal-title" id="exampleModalLabel">Agenda untuk Ruangan ini</h5> </div>
                    <div class="modal-body">
                        <div class="row" id="form-detail">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="">Judul Agenda</label>
                                    <input type="text" class="form-control" name="title" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="">Mulai meeting</label>
                                    <input type="text" class="form-control" name="start_date" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="">Selesai meeting</label>
                                    <input type="text" class="form-control" name="finish_date" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-book" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header"> <h5 class="modal-title" id="exampleModalLabel">Agenda untuk Ruangan ini</h5> </div>
                    <div class="modal-body">
                        <form action="/book" method="post">
                            @csrf
                            <div class="row" id="form-book">
                                <input type="hidden" class="form-control" name="id">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="">Judul Agenda</label>
                                        <input type="text" class="form-control" name="title" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Mulai meeting</label>
                                        <input type="datetime-local" class="form-control" name="start_date" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Selesai meeting</label>
                                        <input type="datetime-local" class="form-control" name="finish_date" required>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Booking</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript">
        function details(id){
            $.ajax({
                url:'/book/'+id,
                method: 'GET',
                data: {id:id, _token:'{{csrf_token()}}'},
                success:function(res){
                    $('#modal-detail').modal('show')
                    $('#form-detail [name="title"]').val(res.data.title)
                    $('#form-detail [name="start_date"]').val(res.data.start_date)
                    $('#form-detail [name="finish_date"]').val(res.data.finish_date)
                }
            })
        }

        function book(id){
            $('#modal-book').modal('show')
            $('#form-book [name="id"]').val('')
            $('#form-book [name="id"]').val(id)
        }

        
    function cancel(id){
        Swal.fire({
            title: 'Apakah Anda Yakin?',
            text: "Agenda untuk ruangan ini akan dihapus atau di kosongkan kembali",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yakin'
            }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url:'/book/cancel/'+id,
                    method: 'POST',
                    data: {id:id, _token:'{{csrf_token()}}'},
                    success:function(res){
                        if (res==true) {
                            Swal.fire(
                                'Cancelled!',
                                'Ruangan ini berhasil di kosongkan',
                                'success'
                            )
                            location.reload()
                        } else {
                            Swal.fire(
                                'Oops!',
                                'Sepertinya ada masalah di server, mohon coba beberapa saat lagi',
                                'danger'
                            )
                        }
                    }
                })
            }
        })
    }

    function cancelAll(){
        Swal.fire({
            title: 'Apakah Anda Yakin?',
            text: "Semua Agenda untuk ruangan akan dihapus atau di kosongkan kembali",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yakin'
            }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url:'/cancelAll',
                    method: 'GET',
                    success:function(res){
                        if (res==true) {
                            Swal.fire(
                                'Cancelled!',
                                'Seluruh ruangan berhasil di kosongkan',
                                'success'
                            )
                            location.reload()
                        } else {
                            Swal.fire(
                                'Oops!',
                                'Sepertinya ada masalah di server, mohon coba beberapa saat lagi',
                                'danger'
                            )
                        }
                    }
                })
            }
        })
    }
    </script>
</html>