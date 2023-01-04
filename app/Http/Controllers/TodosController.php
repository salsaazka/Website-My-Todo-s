<?php

namespace App\Http\Controllers;

use App\Models\todos;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
//untuk semua yang berhubungan dengan tanggal, bulan, tahun 

class TodosController extends Controller
{
    public function login()
    {
        return view('dashboard.login');  
    }

    public function register()
    {
        return view('dashboard.register');
    }

    public function inputRegister(Request $request)
    {
     //testing hasil input
     // dd($request->all());

     //validasi atau  aturan value column pada DB
    $request->validate([
        'name' => 'required|min:4|max:50',
        'email' => 'required',
        'password' => 'required',
        'username' => 'required|min:4|max:8',
    ]);
    
    //tambah data ke DB bagian table users
    // User::create($request->all());
    User::create([
        'name' => $request->name,
        'username'=> $request->username,
        'email'=> $request->email,
        'password'=> Hash::make($request->password),
        'role' =>'user',
    ]);

    //apabila berhasil akan diarahkan ke halaman login dengan pesan success
    return redirect('/')->with('success', 'Anda berhasil membuat akun!');

    }

    public function auth(Request$request)
    {
        $request->validate([
            //required data harus diisi
            'username' => 'required|exists:users,username',
            'password' => 'required',
        ],
        [
            'username.exists' => "Username ini tidak tersedia"
            //username akan di cek ada atau tidak di database kalau tidak ada akan diberi pesan
        ]);

        $user = $request->only('username', 'password');
        //auth fitur untuk menyimpan data dari login user 
        if (Auth::attempt($user)) {
            return redirect()->route('todo.index');
        } else {
            return redirect('/')->with('fail', 'Gagal login, silahkan periksa dan coba lagi!');
        }

    }

    public function logout()
    {
        //menghapus history login
        Auth::logout();
        //mengarahkan ke halaman login
        return redirect('/');
    }
   
    public function index()
    {   //ambil semua data Todo ->  Todo::All
        //cari data todo yang punya user_id nya sama dengan id orang yang login lalu data diambil
        //kalau filternya ada lebih dari 1 dibuat array multi dimensi
        $todos = Todos::where([
            ['user_id', '=', Auth::user()->id],
            ['status', '=', 0],])->get();

        //menampilkan file index di folder dashboard dan membawa data dari var yang bernama todos
        return view('dashboard.index', compact('todos')); 
        //samakan nama compact dengan var
    }

    public function complated()
    {
        $todos = Todos::where([
            ['user_id', '=', Auth::user()->id],
            ['status', '=', 1],])->get();

        return view('dashboard.complated', compact('todos'));
    }

    public function updateComplated($id)
    {
        //$id pada parameter mengambil data dari path dinamis { $id}
        //cari data yang memiliki value column id sama dengan data id yang dikirim ke route, maka update baris data tersebut
        Todos::where('id', $id)->update([
            'status' => 1,
            'done_time' => Carbon::now(),
        ]);
        //jika berhasil akan diarahkan ke halaman list todo complated dengan pemberitahuan
        return redirect()->route('todo.complated')->with('done', 'Todo sudah selesai dikerjakan');
    }
    public function create()
    {
        return view('dashboard.create');
    }

    public function store(Request $request)
    {
        //validasi
        $request->validate([
            'title' => 'required|min:3',
            'date' => 'required',
            'description' => 'required|min:8',
        ]);

        //tambah data ke DB TODO
        Todos::create([
            'title' => $request->title,
            'date' => $request->date,
            'description' => $request->description,
            'status' => 0,
            'user_id' => Auth::user()->id,
        ]);
        return redirect()->route('todo.index')->with('successAdd', 'Anda berhasil menambahkan data ToDo!');
    }

    public function show(todos $todos)
    {
        //
    }

    public function edit($id)
    {
        //menampilkan form edit data
        $todo = Todos::where('id' ,$id)->first();
        return view('dashboard.edit', compact('todo'));
    }

    public function update(Request $request, $id)
    {
          //validasi
        $request->validate([
            'title' => 'required|min:3',
            'date' => 'required',
            'description' => 'required|min:8',
          
        ]);
       
        //update data yang id nya sama dengan id dari route, updatenya ke db bagian table todos
        Todos::where('id', $id)->update([
            'title' => $request->title,
            'date' => $request->date,
            'description' => $request->description,
            'status' => 0,
            'user_id' => Auth::user()->id,
        ]);//untuk tau data mana yang mau di update

        //jika berhasil akan diarahkan ke halaman awal
        return redirect('/todo')->with('successUpdate', 'Data berhasil diperbarui!');
        
    }

  
    public function destroy($id)
    {
        //parameter $id akan mengambil data dari path dinamis {$id}
        //cari data yang isian column id nya sama dengan $id yang dikirim ke path dinamis
        //kalau ada data diambil dan dihapus
        Todos::where('id', $id)->delete();
        //kalau berhasil akana dikembalikan ke halaman list todo dengan pemberitahuan
        return redirect()->route('todo.index')->with('deleted', 'Berhasil menghapus data project');
        // return redirect('/todo')->with('deleted', 'Berhasil menghapus data project ');
    
    }
    public function detail()
    {
        $user = user::where('id', Auth::user()->id)->first();
       return view('dashboard.detail', compact('user'));
    }
    public function data()
    {
        $users = user::all();
        return view('dashboard.data', compact('users'))->with('i', (request()->input('page',1)-1));
    }

    public function detailUpload()
    {
    
        return view('dashboard.upload-profile');
    }

    public function detailChange(Request $request)
    {
        //validasi mimes: menentukan ekstensi fiel yang boleh diupload
        //image: menentukan bahwa fie yang di upload hanya boleh berbentuk image
        $request->validate([
            'image_profile' => 'required|image|mimes:png,jpg,jpeg,gif,svg',
        ]);

        //cara kak fema
        //memasukkan file yang diupload ke input name nya image_profile ke dalam variable
        $image = $request->file('image_profile');
        //mengubah nama file yang diupload menjadi waktu random.ekstensinya
        $imgName = time().rand().'.'.$image->extension();
        //cek apakah pada public/asset/img/ sudah terdapat file image
        //jika tidaak (!) maka didalam if akan dijalankan 
        //$image->getClientOriginalName() mengambil nama original dari file yang diupload
        if(!file_exists(public_path('/assets/img/'.$image->getClientOriginalName()))){
            //set untuk menyimpan file nya
            $dPath = public_path('/assets/img/');
            //memindahkan file yang diupload ke directory yang telah ditentukan
            $image->move($dPath, $imgName);
            $uploaded = $imgName;
        }else{
            $uploaded = $image->getClientOriginalName();
        }
        //kirim nama file ke column image_profile di db, jika berhasil diarahkan kembali ke halaman profile
        User::where('id', Auth::user()->id)->update([
                'image_profile' => $uploaded,
        ]);
        return redirect()->route('todo.detail')->with('success', 'Image uploaded Successfully!');
      
        //CARA AWAL
        // $request->validate([
        //     'image_profile' => 'required|image|mimes:png,jpg,jpeg,gif,svg|max:2048'
        // ]);
        // $imageName = time().'.'.$request->image_profile->extension();

        // // Public Folder
        // $request->image_profile->move(public_path('/assets/img/'), $imageName);
        // User::where('id', Auth::user()->id)->update([
        //     'image_profile' => $imageName
        // ]);

        // return redirect('todo/detail')->with('success', 'Image uploaded Successfully!')
        // ->with('image_profile', $imageName);
     }
    //middleware
    public function error()
    {

        return view('dashboard.error');
    }
}
