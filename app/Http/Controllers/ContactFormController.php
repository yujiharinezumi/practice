<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// ここでモデルを呼び出す必要がある
use App\Models\ContactForm;

use Illuminate\Support\Facades\DB;
use App\Services\CheckFormData;

class ContactFormController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Eloquent ORMを使った書き方、全てのデータを取得する
        // $contacts = ContactForm::All();
        //クエリビルダーを使う方法
        //DBファサードを使う
        $contacts = DB::table('contact_forms')
        ->select('id','your_name','title','created_at')
        ->orderBy('created_at','desc')
        ->get();
        // dd($contacts);
        return view('contact.index',compact('contacts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('contact.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // ContactFormモデルをインスタンス化する
        $contact = new ContactForm;
        //$_POST['name']
        //ここの→はメソッドではなくてプロパティ（変数）
        $contact->your_name = $request->input('your_name');
        $contact->title = $request->input('title');
        $contact->email = $request->input('email');
        $contact->url = $request->input('url');
        $contact->gender = $request->input('gender');
        $contact->age = $request->input('age');
        $contact->contact = $request->input('contact');

        $contact->save();

        return redirect('contact/index');

        // dd($your_name);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $contact = ContactForm::find($id);

        $gender = checkFormData::checkGender($contact);
        $age = checkFormData::checkAge($contact);




        return view('contact.show',compact('contact','gender','age'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $contact = ContactForm::find($id);

        return view('contact.edit',compact('contact'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //

        // ContactFormモデルをインスタンス化する
        //$contact = new ContactForm;

        $contact = ContactForm::find($id);


        //$_POST['name']
        //ここの→はメソッドではなくてプロパティ（変数）
        $contact->your_name = $request->input('your_name');
        $contact->title = $request->input('title');
        $contact->email = $request->input('email');
        $contact->url = $request->input('url');
        $contact->gender = $request->input('gender');
        $contact->age = $request->input('age');
        $contact->contact = $request->input('contact');

        $contact->save();

        return redirect('contact/index');

        // dd($your_name);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $contact = ContactForm::find($id);
        $contact->delete();

        return redirect('contact/index');


    }
}
