<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Buku;

class bukuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $batas = 5;
        $jumlah_buku = Buku::count();
        $data_buku = Buku::orderBy('id', 'desc')->paginate($batas);
        $no = 1 + ($batas * ($data_buku->currentPage() - 1));
        $jumlah_harga = Buku::sum('harga');
        return view('buku.index', compact('data_buku','no', 'jumlah_buku', 'jumlah_harga'));
   
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('buku.create');
    
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $customMessages = [
            'judul.required' => 'Kolom judul wajib diisi.',
            'judul.string' => 'Kolom judul harus berisi teks.',
            'penulis.required' => 'Kolom penulis wajib diisi.',
            'penulis.string' => 'Kolom penulis harus berisi teks.',
            'penulis.max' => 'Kolom penulis maksimal 30 karakter.',
            'harga.required' => 'Kolom harga wajib diisi.',
            'harga.numeric' => 'Kolom harga harus berisi angka.',
            'tgl_terbit.required' => 'Kolom tanggal terbit wajib diisi.',
            'tgl_terbit.date' => 'Kolom tanggal terbit harus berisi tanggal yang valid.',
        ];
        
        // $this->validate($request, [
        //     'judul' => 'required|string',
        //     'penulis' => 'required|string|max:30',
        //     'harga' => 'required|numeric',
        //     'tgl_terbit' => 'required|date',
        // ], $customMessages);

        $buku = new Buku;
        $buku->judul = $request->judul;
        $buku->penulis = $request->penulis;
        $buku->harga = $request->harga;
        $buku->tgl_terbit = $request->tgl_terbit;
        $buku->save();
        return redirect('/buku')->with('pesan', 'Data Buku Berhasil Disimpan');
    
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $buku = Buku::find($id);
        return view('edit', compact('buku'));
   
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $customMessages = [
            'judul.required' => 'Kolom judul wajib diisi.',
            'judul.string' => 'Kolom judul harus berisi teks.',
            'penulis.required' => 'Kolom penulis wajib diisi.',
            'penulis.string' => 'Kolom penulis harus berisi teks.',
            'penulis.max' => 'Kolom penulis maksimal 30 karakter.',
            'harga.required' => 'Kolom harga wajib diisi.',
            'harga.numeric' => 'Kolom harga harus berisi angka.',
            'tgl_terbit.required' => 'Kolom tanggal terbit wajib diisi.',
            'tgl_terbit.date' => 'Kolom tanggal terbit harus berisi tanggal yang valid.',
        ];

        $this->validate($request, [
            'judul' => 'required|string',
            'penulis' => 'required|string|max:30',
            'harga' => 'required|numeric',
            'tgl_terbit' => 'required|date',
        ], $customMessages);

        $buku = Buku::find($id);
        $buku->update([
            'judul' => $request->judul,
            'penulis' => $request->penulis,
            'harga' => $request->harga,
            'tgl_terbit' => $request->tgl_terbit,
        ]);
        return redirect('/buku')->with('pesan', 'Data Buku Berhasil Disimpan');
   
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $buku = Buku::find($id);
        $buku->delete();
        return redirect('/buku')->with('pesan', 'Data Buku Berhasil Dihapus');
        
    }

    public function search(Request $request){
        $batas = 5;
        $cari = $request->kata;
        $data_buku = Buku::where('judul', 'like', "%".$cari."%")->orwhere('penulis', 'like', "%".$cari."%")
            ->paginate($batas);
        $jumlah_buku = Buku::count();
        $no = 1 + ($batas * ($data_buku->currentPage() - 1));
        return view('search', compact('data_buku','no', 'jumlah_buku', 'cari'));
    }
}
