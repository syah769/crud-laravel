<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Pegawai</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"
        integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <h1 class="text-center mb-4">Senarai Pegawai</h1>
    <div class="container">
        <a href="/tambahpegawai" class="btn btn-success">Add +</a>
        <div class="row">
            {{-- @if ($message = Session::get('success'))
                <div class="alert alert-success" role="alert">
                    {{ $message }}
                </div>
            @endif --}}
            <thead>
                <table class="table">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Gender</th>
                        <th scope="col">Phone No</th>
                        <th scope="col">Photo</th>
                        <th scope="col">Registration Date</th>
                        <th scope="col">Action</th>
                    </tr>
                    <tbody>
            </thead>
            {{-- kita buat foreach untuk loop the data. Then kita recall variable $data dari EmployeeController.
                    $item juga adalah variable. Nak tukarkan ke $row pon boleh --}}
            {{-- $item->name kt bwh apa bagai ni, kita fetch direct dari nama column yg dlm db --}}
            @php
                $no = 1;
            @endphp
            @foreach ($data as $row)
                <tr>
                    <th scope="row">{{ $no++ }}</th>
                    <td>{{ $row->name }}</td>
                    <td>{{ $row->gender }}</td>
                    <td>{{ $row->phoneno }}</td>
                    <td>
                        <img src="{{ asset('photopegawai/' . $row->photo) }}" style="width: 45px;" alt="">
                    </td>
                    <td>{{ $row->created_at->format('d-m-Y') }}</td>
                    <td>
                        {{-- igt ya, /displaydata/ ni sebenarnya adalah dari routes, check web.php. Dan {{ $row->id}} tu dari column database --}}
                        <a href="/displaydata/{{ $row->id }}" class="btn btn-info">Edit</a>
                        <a href="#" class="btn btn-danger delete" data-id="{{ $row->id }}">Delete</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
    </script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
        integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>
<script>
    //.delete tu aku ambik dari nama class button Delete. Cer tgk dekat class="btn btn-danger delete"  di button Delete tu. So, kita ambik dari class dan kena letak titik (.)
    $('.delete').click(function() {
        //buat variable as a pegawaiid, dan kita recall semula data-id dari button Delete. Ini disebabkan data-id tu berisi id user. Refer je dekat button Delete kalau tak fhm
        var pegawaiid = $(this).attr('data-id');
        swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this imaginary file!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    //utk yg ni aku tak fhm sgt, cuma yang aku tau kita letak balik routes. Cer tgk web.php route untuk delete. Then, kita panggil semula variable pegawaiid tadi dgn ada + +. Aku tak fhm sgt la, hahaha
                    window.location = "/delete/" + pegawaiid + " "
                    swal("Poof! Your imaginary file has been deleted!", {
                        icon: "success",
                    });
                } else {
                    swal("Your imaginary file is safe!");
                }
            });
    });

    //jika session ni ada 'success' yg diretrieve dari EmployeeController (line 39 & 69), maka toast akan display based on session tersebut
    //kalau hg add data, akan display "data inserted successfull". Kalau hg delete data, akan display "data deleted successfull". So, ia based on keyword success dan session lain2
    @if (Session::has('success'))
        toastr.success("{{ Session::get('success') }}");
    @endif
</script>

</html>
