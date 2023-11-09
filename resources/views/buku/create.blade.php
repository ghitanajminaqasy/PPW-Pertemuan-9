<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.rtl.min.css" integrity="sha384-nU14brUcp6StFntEOOEBvcJm4huWjB0OcIeQ3fltAfSmuZFrkAif0T+UtNGlKKQv" crossorigin="anonymous">
    <title>Buku Create</title>
</head>
<body class="container" style="margin-top: 16px">
    <div class="card">
        <div class="card-header text-center" style="background-color: #E9967A; color: beige"><h2>Tambah Buku</h2></div>
        <div class="card-body">
            @if(count($errors) > 0)
                <ul class="alert alert-danger list-group">
                    @foreach ($errors->all() as $error)
                        <li class="list-group-item">{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
            <form method="POST" action="{{ route('buku.store') }}">
            @csrf
                <div class="form-group">
                    <label for="inputJudul">Judul</label> 
                    <input type="text" class="form-control" name="judul" id="inputJudul">
                </div>
                <div class="form-group">
                    <label for="inputPenulis">Penulis</label> 
                    <input type="text" class="form-control" name="penulis" id="inputPenulis">
                </div>
                <div class="form-group">
                    <label for="inputHarga">Harga</label> 
                    <input type="text" class="form-control" name="harga" id="inputHarga">
                </div>
                <div class="form-group">
                    <label for="inputTgl_terbit">Tanggal Terbit</label> 
                    <input type="date" class="date form-control" name="tgl_terbit" id="inputTgl_terbit" placeholder="yyyy/mm/dd">
                </div> 
                <div class="form-group">
                    <label for="thumbnail">File</label> 
                    <input type="file" class="file form-control" name="thumbnail" id="thumbnail" placeholder="file">
                </div>
                
                <div class="col-span-full mt-6">
                        <label for="gallery" class="block text-sm font-medium leading-6 text-gray-900">Gallery</label>
                        <div class="mt-2" id="fileinput_wrapper">
                        </div>  
                <a href="javascript:void(0);" id="tambah" onclick="addFileInput()">Tambah</a>
                        <script type="text/javascript">
                            function addFileInput () {
                                var div = document.getElementById('fileinput_wrapper');
                                div.innerHTML += '<input type="file" name="gallery[]" id="gallery" class="block w-full mb-5" style="margin-bottom:5px;">';
                            };
                        </script>
                </div>    
                &nbsp;          

                <div>
                    <button type="submit" class="btn btn-primary"><i class="fa-regular fa-floppy-disk"></i>&nbsp;Simpan</button>
                    <a href="/buku" class="btn btn-danger"><i class="fa-solid fa-ban"></i>&nbsp;Batal</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>