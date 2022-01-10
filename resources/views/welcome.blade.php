<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Booking Room</title>
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="{{url('')}}/assets/css/style.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    </head>
    <div class="container">
        <div class="row">
            <div class="col-md-12 mb-4 text-center">
                <h5>Booking Room</h5>
                <p>Silahkan pilih ruangan yang masih kosong untuk booking ruangan baru</p>
            </div>
        </div>
        <div class="row">
            @foreach ($data as $row)
                <div class="col-md-2 my-2">
                    @if ($row->status == 'isi')
                        <div class="card card-2" onclick="danger()">
                            <p class="text-danger">{{$row->name}}</p>
                        </div>
                    @else
                        <div class="card card-1" onclick="detail({{$row->id}})">
                            <p>{{$row->name}}</p>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.slim.min.js" integrity="sha256-u7e5khyithlIdTpu22PHhENmPcRdFiHRjhAuHcs05RI=" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript">
        function danger(){
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Ruangan ini sudah terisi',
            })
        }

        function detail(id){
            Swal.fire({
                title: 'Booking?',
                text: "Ruangan ini masih kosong",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Booking'
                }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url:'/book',
                        method: 'POST',
                        data: {id:id, _token:'{{csrf_token()}}'},
                        success:function(res){
                            if (res==true) {
                                Swal.fire(
                                    'Booked!',
                                    'Ruangan ini berhasil di booking',
                                    'success'
                                )
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