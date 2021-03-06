<?php
/*File PenggunaController.php*/
namespace App\Http\Controllers; 

use Illuminate\Http\Request;
use Hash;
use App\Http\Requests;
use App\Pengguna;

class PenggunaController extends Controller
{
    //
	public function awal(){
		//return "Hello dari PenggunaController";
		$data = pengguna::where('level','user')->get(); 
		return view('pengguna.awal',compact('data'));
	}

	public function tambah(){
		//return $this->simpan();
		return view('Auth.register');
	}
	public function simpan(Request $input){

		$this->validate($input,[
			'username'=>'required',
			'password'=>'required',	
		]);

		$pengguna= new Pengguna();
		$pengguna->username=$input->username;
		$pengguna->email=$input->email;
		$pengguna->password=$input->password;
		$informasi = $pengguna->save() ? 'Berhasil simpan data' :'Gagal simpan data';
		return redirect('/')->with(['informasi'=>$informasi]);
		//$pengguna->save();
		//return "data dengan username {$pengguna->username} telah disimpan";
	}
	public function edit($id){
		$pengguna=pengguna::find($id);
		return view('pengguna.edit')->with(array('pengguna' => $pengguna ));
	}
	public function lihat($id){
		$pengguna = Pengguna::find($id);
		return view('pengguna.lihat')->with(array('pengguna' => $pengguna ));	
	}
	public function update($id, Request $input){
		$pengguna= Pengguna::find($id);
		$pengguna->username=$input->username;
		$pengguna->password=$input->password;
		$informasi = $pengguna->save()?'Berhasil update data' :'Gagal update data';
		return redirect('pengguna')->with(['informasi'=>$informasi]);
	}
	public function hapus($id){
		$pengguna=Pengguna::find($id);
		$informasi = $pengguna->delete()?'Berhasil hapus data' :'Gagal hapus data';
		return redirect('pengguna')->with(['informasi'=>$informasi]);
	}
	

}
