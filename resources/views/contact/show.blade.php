@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <p>氏名:{{ $contact->your_name}}</p>
                    <p>件名:{{ $contact->title}}</p>
                    <p>メールアドレス:{{ $contact->email}}</p>
                    <p>URL:{{ $contact->url}}</p>
                    <p>性別:{{ $gender}}</p>
                    <p>年齢:{{ $age}}</p>
                    <p>お問い合わせ内容</p>
                    <p>{{ $contact->contact}}</p>
                    <form method="GET" action="{{ route('contact.edit',['id'=> $contact->id ]) }}">
                    @csrf
                    <input class="btn btn-info" type="submit" value="変更する">
                    </form>
                    <br>
                    <form method="POST" action="{{ route('contact.destroy',['id'=> $contact->id ]) }}" id="delete_{{ $contact->id }}">
                    @csrf 
                    <p><a href="#" class="btn btn-danger" data-id="{{ $contact->id}}" onclick="deletePost(this);">削除する</a></p>
                    </form>

                
                    
                </div>
            </div>
        </div>
    </div>
</div>

<script>

function deletePost(e){
    'user strict';
    if (confirm('本当に削除していいですか？')){
        document.getElementById('delete_' + e.dataset.id).submit();
    }
}
</script>


                


@endsection
