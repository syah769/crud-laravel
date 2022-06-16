<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Pegawai</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
</head>

<body>
    <h1 class="text-center mb-4">Edit Pegawai</h1>
    <div class="container">

        <div class="row justify-content-center">
            <div class="col-8">
                <div class="card">
                    <div class="card-body">
                        <form action="/updatedata/{{ $data->id }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Nama Penuh Saya</label>
                                {{-- $data->name = variable $data tu kita recall dari EmployeeController, dan name pulak kita ambik dari column db --}}
                                <input type="text" name="name" value="{{ $data->name }}" class="form-control"
                                    id="exampleInputEmail1" aria-describedby="emailHelp">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Gender</label>
                                <select class="form-select" name="gender" aria-label="Default select example">
                                    <option selected>{{ $data->gender }}</option>
                                    <option value="man">Man</option>
                                    <option value="woman">Woman</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Phone No</label>
                                <input type="number" name="phoneno" value="{{ $data->phoneno }}"
                                    class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                            </div>
                            <div class="mb-3">
                                <img src="{{ asset('photopegawai/' . $data->photo) }}" style="width: 45px;" alt="">
                                <br>
                                <label for="exampleInputEmail1" class="form-label">Photo</label>
                                <input type="file" name="photo" value="{{ $data->photo }}" class="form-control">
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

</html>
