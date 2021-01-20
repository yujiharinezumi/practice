<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// ここでモデルを呼び出す必要がある
use App\Models\ContactForm;

use Illuminate\Support\Facades\DB;

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

        if($contact->gender === 0){
            $gender = '男性';
        }

        if($contact->gender === 1){
            $gender = '女性';
        }

        if($contact->age === 1){
            $age = '〜19歳';
        }

        if($contact->age === 2){
            $age = '20歳〜29歳';
        }

        if($contact->age === 3){
            $age = '30歳〜39歳';
        }

        if($contact->age === 4){
            $age = '40歳〜49歳';
        }

        if($contact->age === 5){
            $age = '50歳〜59歳';
        }

        if($contact->age === 6){
            $age = '60歳〜';
        }

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
    }
}
