<x-app-layout>
    <x-slot name="header">
        <h2>Daftar Buku</h2>
    </x-slot>    
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.18.1/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.rtl.min.css" integrity="sha384-nU14brUcp6StFntEOOEBvcJm4huWjB0OcIeQ3fltAfSmuZFrkAif0T+UtNGlKKQv" crossorigin="anonymous">
    <title>Buku</title>
    <link href="{{ asset('dist/css/lightbox.min.css') }}" rel="stylesheet">
</head>

<body>
<script src="{{ asset('dist/js/lightbox-plus-jquery.min.js') }}"></script>

<div class="container" style="margin-top: 16px">
    <div class="col-md-12">

        @if(Session::has('pesan'))
            <div class="alert alert-success">{{Session::get('pesan')}}</div>
        @endif

        <div class="card">
            <div class="card-header text-center" style="background-color: #E9967A; color: white"><h3>Daftar Buku</h3></div>
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <a style="left: right; margin-bottom: 16px" href="{{ route('buku.create') }}">
                        <button class="btn btn-success"><i class="fa-solid fa-plus"></i>&nbsp;Tambah Buku</button>
                    </a>

                    @if(Auth::check() && Auth::user()->role == 'admin')
                   
                    <form action="{{ route('buku.search') }}" method="get">
                        @csrf
                        <input type="text" name="kata" class="form form-control" placeholder="Cari ..." style="float:right;">
                    </form>
                    @endif

                </div>

                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>Judul Buku</th>
                            <th>Penulis</th>
                            <th>Harga</th>
                            <th>Tgl. Terbit</th>
                            <th>Foto</th>
                            <th>Aksi</th>   
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($data_buku as $buku)
                    
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $buku->judul }}</td>
                                <td>{{ $buku->penulis }}</td>
                                <td>{{ "Rp ".number_format($buku->harga, 0, ',', '.') }}</td>
                                <td>{{ ($buku->tgl_terbit)->format('d/m/Y') }}</td>
                                <td>
                                    
                                @if ( $buku->filepath )
                                <div class="relative h-10 w-10">
                                    <img
                                    class="h-50 w-50 object-cover object-center"
                                    src="{{ asset($buku->filepath) }}"
                                    alt=""
                                    />
                                </div>
                                @endif

                                <div class="gallery_items">
                                 @foreach($buku->galleries()->get() as $gallery)
                                 <div class="gallery_item">
                                <img
                                class="rounded-full object-cover object-center"
                                src="{{ asset($gallery->path) }}"
                                alt=""
                                width="400"
                                />
                            </div>
                        @endforeach
                    </div>

                                </td>
                                <td>
                                    <div class="btn-group" role="group" style="overflow-x: auto;">
                                        <a href="{{ route('buku.edit', $buku->id) }}" class="btn btn-primary"><i class="fa-regular fa-pen-to-square"></i>&nbsp;Edit</a>
                                        &nbsp;
                                        <form action="{{ route('buku.destroy', $buku->id) }}" method="POST">
                                            @csrf
                                            <button class="btn btn-danger" onClick="return confirm('Are you sure?')"><i class="fas fa-trash"></i>&nbsp;Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                    @endforeach
                    </tbody>
                </table>
                <div>{{ $data_buku->links() }}</div>
                <div><strong>Jumlah Buku : {{ $jumlah_buku }}</strong></div>
                <div><strong>Jumlah Harga Buku : {{ "Rp ".number_format($jumlah_harga, 0, ',', '.') }}</strong></div>
            </div>
        </div>

        <section id="album" class="py-1 text-center bg-light">
            <div class="container">
                <h2>Buku: {{ $bukus->judul }}</h2>
                <hr>
                <div class="row">
                    @foreach ($galeris as $data)
                    <div class="col-md-4">
                    <a href="{{ asset('iamges/'. $data->foto) }}"   
                    data-lightbox="image-1" data-title="{{ $data->keterangan }}">
                        <img src="{{ asset('images/'.$data->foto) }}" style="width:200px; height:150px"></a>
                        <p><h5>{{ $data->nama_galeri }}</h5></p> 
                    </div>
                    @endforeach
                </div>
                <div>{{ $galeris->links() }}</div>
            </div>
        </section>
    </div>
</body>
</x-app-layout>
