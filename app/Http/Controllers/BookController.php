<?php

namespace App\Http\Controllers;

use App\BookModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
        $this->middleware('auth');
    }

    function index()
    {
        $data = BookModel::all();
        return response($data);
    }

    function show($id)
    {
        $data = BookModel::where('id',$id)->get();
        return response($data);
    }

    public function store(Request $request){
        $data = new BookModel();
        $data->bookNidn = $request->input('bookNidn');
        $data->bookName = $request->input('bookName');
        $data->save();

        return response('Berhasil Tambah Data');
    }

    public function update(Request $request, $id){
        $data = BookModel::where('id',$id)->first();
        $data->bookNidn = $request->input('bookNidn');
        $data->bookName = $request->input('bookName');
        $data->save();

        return response('Berhasil Merubah Data');
    }

    public function destroy($id){
        $data = BookModel::where('id',$id)->first();
        $data->delete();

        return response('Berhasil menghapus data');
    }


    //
}
