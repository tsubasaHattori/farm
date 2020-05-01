@extends('layouts.app')
@section('title', 'Far-mer Home')

@section('style')
<link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endsection

@section('header_script')
@endsection

@section('content')
<div id="home-container" class="container">
    <div onload="Jump()">
    <hr width = "100%">
    <div class="messages-block">
        @foreach ($messages as $index => $message)
        <form name="deleteForm" action="/home/delete/{{ $message['id'] }}" method="POST">
        {{ csrf_field() }}
            @if ($index == 0)
            <div class="day-change-block">
                <span class="day-change">{{ $message['created_at']->format('n/d (D)') }}</span>
            </div>
            @elseif ($index-1 >= 0 && $message['created_at']->day - $messages[$index-1]['created_at']->day)
            <div class="day-change-block">
                <span class="day-change">{{ $message['created_at']->format('n/d (D)') }}</span>
            </div>
            @endif
            <div @if($message['user_id'] == $user['id']) class="message my-message" @else class="message others-message" @endif>
            <div class="upper-line">
                <span class="writer">
                @if (!$message['is_deleted'] && $message['user_id'] == $user['id'])
                <i id="trash" class="fa fa-trash fa-lg" @click="deleteMessage('deleteForm', '/home/delete/{{ $message['id'] }}', 'POST')"></i>
                @endif
                {{ $message['name'] }}
                </span>
            </div>
            <div class="middle-line">
                <span class="time">{{ $message['created_at']->format('G:i') }}</span>
            </div>
            <div class="content-line">
                @if ($message['is_deleted'])
                <span class="content-box-null">
                <span class="content">メッセージが削除されました</span>
                </span>
                @else
                <span class="content-box">
                <span class="content" @click="scrollEnd">{{ $message['content'] }}</span>
                </span>
                @endif
            </div>
            </div>
        </form>
        @endforeach
    </div>

    <hr width = "100%"><center>
    <p class="write" id="jumpto">書き込み</p>
    <form class="store-form" action="/home/store" method="POST">
        @csrf
        内容<br>
        <textarea name="content" id="textfield1" style="width: 100%; height: 80px;" required></textarea><br>
        <input class="btn btn-square-shadow" type="submit" value="投稿" />
    </form>
    <hr width = "100%"></center>
    </div>
</div>
@endsection

@section('footer_script')
<script type="text/javaScript">

var home = new Vue({
    el: "#home-container",
    data: {
        userId: {{ $user['id'] }},
    },
    mounted: function() {
        this.$nextTick(function () {
        //     // ビュー全体がレンダリングされた後にのみ実行されるコード
            // location.href = "#jumpto";
            this.scrollEnd();
        });

    },
    methods: {
        scrollEnd: function() {
            var elementHtml = document.documentElement;
            var bottom = elementHtml.scrollHeight - elementHtml.clientHeight;
            window.scrollTo(0, bottom);
        },

        deleteMessage: function(formName, url, method) {
            if(!window.confirm('本当に削除しますか？')){
                return false;
            }
            // document.deleteform.submit();
            // this->delete_alert(event);
            // サブミットするフォームを取得
            var f = document.forms[formName];

            f.method = method; // method(GET or POST)を設定する
            f.action = url; // action(遷移先URL)を設定する
            f.submit(); // submit する
            return true;
        }
    }
})
</script>
@endsection


