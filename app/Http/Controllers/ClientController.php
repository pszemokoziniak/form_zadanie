<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Models\Client;

use Validator;
use DB;

class ClientController extends Controller
{
    function index() {
        return view('clients.index');
    }
    function save(Request $request){
        $validator = Validator::make($request->all(),[
            'imie'=>'required|alpha',
            'nazwisko'=>'required|alpha',
            'email'=>'required|email|unique:clients',
            'prefix'=>'required|max:3',
            'telefon'=>'required|min:9|max:9',
            'zgoda'=>'required_without_all'
        ], $messages = [
            'imie.required' => 'Imię Wymagane.',
            'nazwisko.required' => 'Nazwisko Wymagane.',
            'email.required' => 'Email Wymagany.',
            'email.email' => 'Email musi mieć format email.',
            'prefix.required' => 'Kierunkowy Wymagany.',
            'telefon.required' => 'Telefon Wymagany.',
            'telefon.min' => 'Telefon musi mieć 9 cyfr.',
            'telefon.max' => 'Telefon musi mieć 9 cyfr.',
            '*.alpha' => 'Pole może zawierać tylko alfabet',
            'zgoda.required_without_all' => 'Zgoda Musi Być :)'
        ]);


        if(!$validator->passes()){
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);

        } else {

            $data = new Client;
            $data->imie=$request->imie;
            $data->nazwisko=$request->nazwisko;
            $data->email=$request->email;
            $data->telefon=$request->telefon;
            $data->prefix_telefon=$request->prefix;
            $data->zgoda=$request->zgoda;
            $data->save();

            $id = $data->id;

            if( $data ) {
                return response()->json(['status'=>1, 'msg'=>'Nowy Użytkownik zarejestrowany', 'id'=>$id]);
            }
        }
    }
    function desc($id) {
        $id_client = $id;
        return view('clients.desc', compact('id_client'));
    }
    function save_desc(Request $request) {
        $data = Client::find($request->id);
        $data->opis_osoby=$request->opis_osoby;
        $saved = $data->save();


        if($saved) {
            Session::flash('saveform', 'Zapisano');
            return redirect('/add_client');
        }


    }

}
