@extends('layout.admin')
@push('css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"
        integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Data Pegawai</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <a href="/tambahpegawai" class="btn btn-success">Add +</a>
            <div class="row g-3 align-items-center mt-2">
                {{-- utk Search function, go to EmployeeController and tgk line 13. Situ functionnya --}}
                <div class="col-auto">
                    <form action="/pegawai" method="GET">
                        <input type="search" name="search" class="form-control">
                    </form>
                </div>
                <div class="col-auto">
                    <a href="/exportpdf" target="_blank" class="btn btn-info">PDF</a>
                    <a href="/exportexcel" target="_blank" class="btn btn-warning">Excel</a>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Import Excel
                    </button>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Import here</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form action="/importexcel" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-body">
                                    <div class="form-group">
                                        <input type="file" name="file" required> {{-- refer EmployeeController line 103, kita post name="file" tu dekat controller --}}
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="row">
                {{-- @if ($message = Session::get('success'))
            <div class="alert alert-success" role="alert">
                {{ $message }}
            </div>
        @endif --}}
                <thead>
                    <table class="table">
                        <tr>
                            <th scope="col">No</th>
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
                @foreach ($data as $index => $row)
                    <tr>
                        <th scope="row">{{ $index + $data->firstItem() }}</th> {{-- $paginator->firstItem() = Get the result number of the first item in the results --}}
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
                {{-- ni nak gtaw cmna ntah, dia mcm <1 2>. Ha benda tu lah --}}
                {{ $data->links() }}
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
        </script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"
            integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
            integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>

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
    @endpush
@endsection
