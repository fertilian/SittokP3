<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Keranjang;
use App\Models\Customer;
use App\Models\DetileJual;
use App\Models\DetilJual;
use App\Models\Jual;
use App\Models\Like;
use App\Models\Paymen;
use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');
    
        $customer = Customer::where('email', $email)->first();
        // Validasi email dan password tidak kosong
if (empty($email) || empty($password)) {
    $response = array(
        'success' => false,
        'message' => 'Email and password are required',
    );
    return response()->json($response, 400);
}

    
        if ($customer) {
            if (Hash::check($password, $customer->password)) {
                $response = array(
                    'id_customer' => $customer->id_customer,
                    'nama_customer' => $customer->nama_customer,
                    'email' => $customer->email,
                    'no_telp_customer' => $customer->no_telp_customer,
                    'alamat' => $customer->alamat,
                    'profil' => $customer->profil
                );
                return response()->json($response);
            } else {
                $response = array(
                    'success' => false,
                    'message' => 'Incorrect password',
                );
                return response()->json($response, 404);
            }
        }
    
        $response = array(
            'success' => false,
            'message' => 'User not found',
        );
        return response()->json($response, 404);
    }
    

    
    public function register(Request $request)
    {
        $email = $request->input('email');
        $password = Hash::make($request->input('password'));
        $nama_customer = $request->input('nama_customer');
        $no_telp_customer = $request->input('no_telp_customer');
        $alamat = $request->input('alamat');
    
        // Validasi jika email sudah terdaftar sebelumnya
        $existingCustomer = DB::table('customers')
            ->where('email', $email)
            ->first();
    
        if ($existingCustomer) {
            $response = array(
                'success' => false,
                'message' => 'Email already registered',
            );
            return response()->json($response);
        }
    
        // Lakukan proses penyimpanan data customer ke database
    
        $customer = DB::table('customers')->insertGetId([
            'email' => $email,
            'password' => $password,
            'nama_customer' => $nama_customer,
            'no_telp_customer' => $no_telp_customer,
            'alamat' => $alamat
        ]);
        if ($customer) {
            $response = array(
                'success' => true,
                'message' => 'Registration successful',
                'data' => array(
                    'id_customer' => $customer,
                    'nama_customer' => $nama_customer,
                    'email' => $email,
                    'no_telp_customer' => $no_telp_customer,
                    'alamat' => $alamat
                )
            );
            return response()->json($response);
        } else {
            $response = array(
                'success' => false,
                'message' => 'Registration failed',
            );
            return response()->json($response);
        }
    }


    public function updateProfile(Request $request)
    {
        $idCustomer = $request->input('id_customer');
        $profileImage = $request->file('profil');
    
        // Validasi jika gambar profil ada
        if ($request->hasFile('profil')) {
            $destinationPath = 'images/';
            $profileImageName = date('YmdHis') . "." . $profileImage->getClientOriginalExtension();
            $profileImage->move($destinationPath, $profileImageName);
            $profileImageUrl = "images/" . $profileImageName;
    
            // Update profil pengguna dengan gambar profil baru
            $updateProfile = DB::table('customers')
                ->where('id_customer', $idCustomer)
                ->update([
                    'profil' => $profileImageUrl
                ]);
    
            if ($updateProfile) {
                $response = array(
                
                        'id_customer' => $idCustomer,
                        'profil' => $profileImageUrl
                   
                );
                return response()->json($response);
            } else {
                $response = array(
                    'success' => false,
                    'message' => 'Failed to update profile',
                );
                return response()->json($response);
            }
        } else {
            $response = array(
                'success' => false,
                'message' => 'No profile image found',
            );
            return response()->json($response);
        }
    }
    
    public function getUserById(Request $request)
    {
        $idCustomer = $request->input('id_customer');
    
        $customer = DB::table('customers')
            ->where('id_customer', $idCustomer)
            ->first();
    
        if ($customer) {
            $response = array(
                'id_customer' => $customer->id_customer,
                'nama_customer' => $customer->nama_customer,
                'email' => $customer->email,
                'no_telp_customer' => $customer->no_telp_customer,
                'alamat' => $customer->alamat,
                'profil' => $customer->profil
            );
        } else {
            $response = array(
                'success' => false,
                'message' => 'User not found',
                'data' => null
            );
        }
    
        return response()->json($response);
    }
    


    public function getDataBarang(Request $request)
    {
        $id_customer = $request->input('id_customer');
    
        $barangs = Barang::all();
    
        if ($barangs->isEmpty()) {
            $response = array(
                'success' => false,
                'message' => 'No data found',
                'data' => null
            );
        } else {
            $response = $barangs->toArray();
    
            // Fetch the like data for the given customer ID
            $likes = Like::where('id_customer', $id_customer)->whereIn('id_barang', $barangs->pluck('id_barang'))
            ->orderBy('created_at', 'desc')
            ->get();
    
            // Add like status to each barang in the response
            foreach ($response as &$barang) {
                $barang['is_liked'] = $likes->contains('id_barang', $barang['id_barang']);
            }
        }
    
        return response()->json($response);
    }

    public function updateDataBarang(Request $request)
{
    $id_barang = $request->input('id_barang');
    $qty = $request->input('qty');

    $barang = Barang::find($id_barang);

    if (!$barang) {
        $response = array(
            'success' => false,
            'message' => 'Barang not found',
            'data' => null
        );
        return response()->json($response);
    }

    $jumlah_barang = $barang->jumlah_barang - $qty;
    $barang->jumlah_barang = $jumlah_barang;
    $barang->save();

    $response = 
       $barang;
   

    return response()->json($response);
}

    
    public function getDetilBarang(Request $request)
    {
        $id_barang = $request->input('id_barang');
    
        // Mencari barang berdasarkan id_barang
        $barang = Barang::find($id_barang);
    
        if (!$barang) {
            $response = array(
                'success' => false,
                'message' => 'No data found',
                'data' => null
            );
        } else {
            $response = $barang->toArray();
    
            // Mengambil data like untuk id_barang yang diberikan
            $likes = Like::where('id_barang', $id_barang)->get();
    
            // Menambahkan status like pada response barang
            $response['is_liked'] = !$likes->isEmpty();
        }
    
        return response()->json($response);
    }

    public function getDataBarangFav(Request $request)
    {
        $id_customer = $request->input('id_customer');
    
        $barangs = Barang::all();
    
        if ($barangs->isEmpty()) {
            $response = array(
                'success' => false,
                'message' => 'No data found',
                'data' => null
            );
        } else {
            // Fetch the like data for the given customer ID
            $likes = Like::where('id_customer', $id_customer)->whereIn('id_barang', $barangs->pluck('id_barang'))->get();
    
            // Filter barang-barang yang memiliki is_liked bernilai true
            $likedBarangs = $likes->pluck('id_barang')->toArray();
    
            // Filter barang-barang yang memiliki is_liked bernilai true
            $response = $barangs->filter(function ($barang) use ($likedBarangs) {
                return in_array($barang['id_barang'], $likedBarangs);
            })->values()->toArray();
    
            // Tambahkan is_liked dengan nilai true pada setiap barang
            foreach ($response as &$barang) {
                $barang['is_liked'] = true;
            }
        }
    
        return response()->json($response);
    }
    
    

    
    public function getDataKategori(Request $request)
    {
        $kategoris = Kategori::all();

        if ($kategoris->isEmpty()) {
            $response = array(
                'success' => false,
                'message' => 'No data found',
                'data' => null
            );
        } else {
            $response = array(
                'success' => true,
                'message' => 'Data retrieved successfully',
                'data' => $kategoris
            );
        }

        return response()->json($response);
    }

    public function addDataKeranjang(Request $request)
    {
        $data = $request->only(['id_customer', 'id_barang', 'qty']);
    
        // Check if required fields are present
        $requiredFields = ['id_customer', 'id_barang', 'qty'];
        foreach ($requiredFields as $field) {
            if (!isset($data[$field]) || empty($data[$field])) {
                return response()->json([
                    'error' => 'The ' . $field . ' field is required.'
                ], 400);
            }
        }
    
        $keranjang = Keranjang::create($data);
    
        return response()->json([
            'message' => 'Data added successfully',
            'data' => $keranjang
        ], 200);
    }

    public function updateStatusKeranjang(Request $request)
    {
        $idKeranjang = $request->input('id_keranjang');
    
        if (!$idKeranjang) {
            return response()->json([
                'error' => 'Invalid input: id_keranjang is required',
            ], 400);
        }
    
        $keranjang = Keranjang::find($idKeranjang);
    
        if (!$keranjang) {
            return response()->json([
                'error' => 'Keranjang not found',
            ], 404);
        }
    
        $keranjang->status = 'selesai';
        $keranjang->save();
    
        return response()->json(
             $keranjang
       , 200);
    }
    

    public function updateDataKeranjang(Request $request)
{
    $data = $request->only(['id_keranjang']);

    // Check if required fields are present
    $requiredFields = ['id_keranjang'];
    foreach ($requiredFields as $field) {
        if (!isset($data[$field]) || empty($data[$field])) {
            return response()->json([
                'error' => 'The ' . $field . ' field is required.'
            ], 400);
        }
    }

    // Find the Keranjang by id_keranjang
    $keranjang = Keranjang::find($data['id_keranjang']);

    if (!$keranjang) {
        return response()->json([
            'error' => 'Keranjang not found.'
        ], 404);
    }

    // Increment qty by 1
    $keranjang->qty += 1;
    $keranjang->save();

    return response()->json(
        $keranjang
    , 200);
}

public function updateQty(Request $request)
{
    $data = $request->validate([
        'id_keranjang' => 'required',
    ]);

    $id_keranjang = $data['id_keranjang'];

    // Find the Keranjang by id_keranjang
    $keranjang = Keranjang::find($id_keranjang);

    if (!$keranjang) {
        return response()->json([
            'error' => 'Keranjang not found.'
        ], 404);
    }

    // Decrement qty by 1
    if ($keranjang->qty > 1) {
        $keranjang->qty -= 1;
    } elseif ($keranjang->qty == 1) {
        // Delete the Keranjang if qty is 1
        $keranjang->delete();

        return response()->json([
            
        ], 200);
    } else {
        return response()->json([
            'error' => 'Cannot decrement qty below zero.'
        ], 400);
    }

    $keranjang->save();

    return response()->json($keranjang
    , 200);
}




    public function addDataFavorit(Request $request)
    {
        $data = $request->only(['id_customer', 'id_barang']);
    
        // Check if required fields are present
        $requiredFields = ['id_customer', 'id_barang'];
        foreach ($requiredFields as $field) {
            if (!isset($data[$field]) || empty($data[$field])) {
                return response()->json([
                    'error' => 'The ' . $field . ' field is required.'
                ], 400);
            }
        }
    
        $keranjang = Like::create($data);
    
        return response()->json($keranjang, 200);
    }


    public function deleteDataFavorit(Request $request)
    {
        $data = $request->only(['id_customer', 'id_barang']);
    
        // Check if required fields are present
        $requiredFields = ['id_customer', 'id_barang'];
        foreach ($requiredFields as $field) {
            if (!isset($data[$field]) || empty($data[$field])) {
                return response()->json([
                    'error' => 'The ' . $field . ' field is required.'
                ], 400);
            }
        }
    
        // Delete the favorit record
        Like::where('id_customer', $data['id_customer'])
            ->where('id_barang', $data['id_barang'])
            ->delete();
    
        return response()->json([
            'message' => 'The favorit record has been deleted successfully.'
        ], 200);
    }
    


    public function getDataKeranjang(Request $request)
    {
        $data = $request->validate([
            'id_customer' => 'required',
        ]);  
    
        $keranjang = Keranjang::join('barang', 'keranjang.id_barang', '=', 'barang.id_barang')
            ->where('keranjang.id_customer', $data['id_customer'])
            ->where('keranjang.status','belum')
            ->select('keranjang.*', 'barang.harga', 'barang.gambar', 'barang.merk_barang')
            ->get();
    
        if ($keranjang->isEmpty()) {
            return response()->json([
                'message' => 'Data not found'
            ], 404);
        }
    
        $totalJumlah = 0;
        foreach ($keranjang as $item) {
            $jumlah = $item->harga * $item->qty;
            $item->jumlah = $jumlah;
            $totalJumlah += $jumlah;
        }
    
        return response()->json(
            $keranjang
        , 200);
    }



    public function showByCustomer(Request $request)
    {
        $idCustomer = $request->input('id_customer');
    
        $detileJual = DetileJual::join('keranjang', 'detil_jual.id_keranjang', '=', 'keranjang.id_keranjang')
            ->join('jual', 'keranjang.id_jual', '=', 'jual.id_jual')
            ->join('barang', 'keranjang.id_barang', '=', 'barang.id_barang')
            ->select('detil_jual.*', 'keranjang.id_keranjang', 'jual.*', 'barang.merk_barang', 'barang.gambar', 'barang.deskripsi')
            ->where('jual.id_customer', $idCustomer)
            ->get();
    
        if ($detileJual->isEmpty()) {
            return response()->json(['message' => 'Data not found'], 404);
        }
    
        return response()->json(['data' => $detileJual], 200);
    }

    public function getTotalKeranjang(Request $request)
    {
        $data = $request->validate([
            'id_customer' => 'required',
        ]);  
    
        $keranjang = Keranjang::join('barang', 'keranjang.id_barang', '=', 'barang.id_barang')
            ->where('keranjang.id_customer', $data['id_customer'])
            ->where('keranjang.status', 'belum')
            ->select('keranjang.*', 'barang.harga', 'barang.gambar', 'barang.merk_barang')
            ->get();
    
        if ($keranjang->isEmpty()) {
            return response()->json([
                'message' => 'Data not found'
            ], 404);
        }
    
        $totalJumlah = 0;
        foreach ($keranjang as $item) {
            $jumlah = $item->harga * $item->qty;
            $item->jumlah = $jumlah;
            $totalJumlah += $jumlah;

        }
    
        return response()->json([
         "jumlah" =>   $totalJumlah]
        , 200);
    }
    

    public function getAllPaymen(Request $request)
    {
        try {
            $paymen = Paymen::all();
            return response()->json( $paymen,200
            );
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve paymen data.',
            ], 500);
        }
    }

    
    public function store(Request $request)
    {
        // Validasi data input
        $request->validate([
            'jual.total' => 'required',
            'jual.total_final' => 'required',
            'jual.alamat' => 'required',
            'jual.nohp' => 'required',
            'jual.nama_lengkap' => 'required',
            'detil_jual' => 'required|array',
            'detil_jual.*.id_keranjang' => 'required',
            'detil_jual.*.id_jual' => 'required',
            'detil_jual.*.jumlah' => 'required',
            'detil_jual.*.harga' => 'required',
            'detil_jual.*.qty' => 'required',
            'jual.bukti_bayar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Validasi untuk bukti bayar
        ]);
    
        // Decode JSON input
        $data = json_decode($request->getContent(), true);
    
        // Simpan data transaksi jual
        $jualData = $data['jual'];
        $jualData['status'] = 'pending'; // Atur status menjadi 'pending'
        $jual = Jual::create($jualData);
    
        // Cek jika ada file bukti bayar yang diunggah
        if ($request->hasFile('jual.bukti_bayar')) {
            $buktiBayar = $request->file('jual.bukti_bayar');
            $buktiBayarPath = $buktiBayar->store('bukti_bayar', 'public');
            $jual->bukti_bayar = $buktiBayarPath;
            $jual->save();
        }
    
        // Simpan detail transaksi jual
        $detilJualData = [];
        foreach ($data['detil_jual'] as $detil) {
            $detilJualData[] = new DetileJual([
                'id_jual' => $detil['id_jual'],
                'id_keranjang' => $detil['id_keranjang'],
                'jumlah' => $detil['jumlah'],
                'harga' => $detil['harga'],
                'qty' => $detil['qty'],
            ]);
        }
        $jual->detilJual()->saveMany($detilJualData);
    
        // Response sukses
        return response()->json(['message' => 'Data transaksi jual berhasil disimpan'], 200);
    }
public function storeJual(Request $request)
{
    // Validasi data input
    $request->validate([
        'total' => 'required',
        'total_final' => 'required',
        'alamat' => 'required',
        'nohp' => 'required',
        'nama_lengkap' => 'required',
        'id_customer' => 'required',
        'bukti_bayar' => 'nullable', // Validasi untuk bukti bayar
    ]);

    // Simpan data transaksi jual
    $jualData = [
        
        'total' => $request->input('total'),
        'total_final' => $request->input('total_final'),
        'alamat' => $request->input('alamat'),
        'nohp' => $request->input('nohp'),
        'nama_lengkap' => $request->input('nama_lengkap'),
        'id_customer' => $request->input('id_customer'),
        'status' => 'belum bayar', // Atur status menjadi 'pending'
    ];

    $jual = Jual::create($jualData);

    // Cek jika ada file bukti bayar yang diunggah
    if ($request->hasFile('bukti_bayar')) {
        $buktiBayar = $request->file('bukti_bayar');
        $buktiBayarPath = $buktiBayar->store('bukti_bayar', 'public');
        $jual->bukti_bayar = $buktiBayarPath;
        $jual->save();
    }

    // Response sukses
    return response()->json($jual, 200);
}

public function updateJual(Request $request)
{
    $request->validate([
        'id_jual' => 'required', // Validasi untuk id_jual
        'bukti_bayar' => 'required|file', // Validasi untuk bukti bayar
    ]);

    $id_jual = $request->input('id_jual');
    $jual = Jual::find($id_jual);

    if (!$jual) {
        // Jika transaksi jual tidak ditemukan, berikan respon error
        return response()->json(['message' => 'Transaksi jual tidak ditemukan'], 404);
    }

    if ($request->hasFile('bukti_bayar')) {
        $buktiBayar = $request->file('bukti_bayar');
        $destinationPath = 'images/';
        $buktiBayarName = date('YmdHis') . "." . $buktiBayar->getClientOriginalExtension();
        $buktiBayar->move($destinationPath, $buktiBayarName);
        $jual->bukti_bayar = "images/" . $buktiBayarName;
    }

    $jual->status = 'Konfirmasi Admin';

    // Simpan perubahan data
    $jual->save();

    return response()->json($jual, 200);
}


public function updateKlaim(Request $request)
{
    $request->validate([
        'id_jual' => 'required', // Validasi untuk id_jual
    ]);

    $id_jual = $request->input('id_jual');
    $jual = Jual::find($id_jual);

    if (!$jual) {
        // Jika transaksi jual tidak ditemukan, berikan respon error
        return response()->json(['message' => 'Transaksi jual tidak ditemukan'], 404);
    }

    $jual->status = 'Selesai';

    // Simpan perubahan data
    $jual->save();

    return response()->json($jual, 200);
}


public function getDataJualByCustomer(Request $request)
{
    // Validasi data input
    $request->validate([
        'id_customer' => 'required',
    ]);

    $idCustomer = $request->input('id_customer');

    // Ambil data penjualan berdasarkan id_customer
    $dataJual = Jual::where('id_customer', $idCustomer)
    ->orderBy('created_at', 'desc')
    ->get();

    if ($dataJual->isEmpty()) {
        return response()->json(['message' => 'Data not found'], 404);
    }

    return response()->json( $dataJual, 200);
}
public function storeDetil(Request $request)
{
    // Validasi data input
    $request->validate([
        'id_jual' => 'required',
        'id_keranjang' => 'required',
        'id_barang' => 'required',
        'jumlah' => 'required',
        'qty' => 'required',
        'harga' => 'required',
        'total_final' => 'required'
    ]);

    // Simpan data detil jual
    $detilJualData = [
        'id_jual' => $request->input('id_jual'),
        'id_keranjang' => $request->input('id_keranjang'),
        'id_barang' => $request->input('id_barang'),
        'jumlah' => $request->input('jumlah'),
        'qty' => $request->input('qty'),
        'harga' => $request->input('harga'),
        'total_final' => $request->input('total_final')
    ];

    $detilJual = DetileJual::create($detilJualData);

    // Response sukses
    return response()->json($detilJual, 200);
}
public function getDetilJual(Request $request)
{
    // Validasi data input
    $request->validate([
        'id_jual' => 'required'
    ]);

    $idJual = $request->input('id_jual');

$detilJual = DetileJual::where('detil_jual.id_jual', $idJual)
    ->join('jual', 'detil_jual.id_jual', '=', 'jual.id_jual')
    ->join('barang', 'detil_jual.id_barang', '=', 'barang.id_barang')
    ->get();

return response()->json($detilJual, 200);


}


public function getNota(Request $request)
{
    $request->validate([
        'id_jual' => 'required',
    ]);

    $idJual = $request->input('id_jual');

    // Ambil data penjualan berdasarkan id_jual
    $dataJual = Jual::where('id_jual', $idJual)->first();

    if (!$dataJual) {
        return response()->json(['message' => 'Data not found'], 404);
    }

    // Ambil data detil transaksi berdasarkan id_jual
    $detilJual = DetileJual::where('id_jual', $idJual)->get();

    // Ambil data keranjang dan barang berdasarkan id_keranjang di detil transaksi
    $keranjangIds = $detilJual->pluck('id_keranjang');
    $keranjang = Keranjang::whereIn('id_keranjang', $keranjangIds)->get();
    $barangIds = $keranjang->pluck('id_barang');
    $barang = Barang::whereIn('id_barang', $barangIds)->get();

    // Menggabungkan semua data menjadi satu array
    $data = [
        'jual' => $dataJual->toArray(),
        'detil_jual' => $detilJual->toArray(),
        'keranjang' => $keranjang->toArray(),
        'barang' => $barang->toArray(),
    ];

    return response()->json($data, 200);
}

public function kategori(Request $request)
{
    $kategori = Kategori::all();

    return response()->json($kategori);
}

}    