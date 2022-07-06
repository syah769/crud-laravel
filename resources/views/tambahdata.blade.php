@extends('layout.admin')

@section('content')

    <body>
        <h1 class="text-center mb-4">Tambah Pegawai</h1>
        <div class="container">

            <div class="row justify-content-center">
                <div class="col-8">
                    <div class="card">
                        <div class="card-body">
                            {{-- why action nya /insertdata? ini disebabkan routes dia. Cer tgk routes dekat web.php, Sebab tu lah kita letak /insertdata --}}
                            <form action="/insertdata" method="POST" enctype="multipart/form-data">
                                {{-- csrf ni wajib implement time nak insert data, dia seolah2 mcm token camtulah --}}
                                @csrf
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Full Name</label>
                                    <input type="text" name="name" class="form-control" id="exampleInputEmail1"
                                        aria-describedby="emailHelp">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Gender</label>
                                    <select class="form-select" name="gender" aria-label="Default select example">
                                        <option selected>Select here</option>
                                        <option value="man">Man</option>
                                        <option value="woman">Woman</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Phone No</label>
                                    <input type="number" name="phoneno" class="form-control" id="exampleInputEmail1"
                                        aria-describedby="emailHelp">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Photo</label>
                                    <input type="file" name="photo" class="form-control">
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
        </script>
    </body>
@endsection
