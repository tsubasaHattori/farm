@extends('layouts.app')
@section('title', 'Far-mer Home')

@section('style')
<link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endsection

@section('header_script')
@endsection

@section('content')
<div id="home-container" class="container">
    <component-message-form
        :auth-user = authUser
        :users = users>
    </component-message-form>
</div>
@endsection

@section('footer_script')
<script type="text/javaScript">

var home = new Vue({
    el: "#home-container",
    data: {
        authUser: @json($auth_user),
        isPosting: false,
        users: @json($users),
    },
    mounted: function() {
        this.$nextTick(function () {
        //     // ビュー全体がレンダリングされた後にのみ実行されるコード
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
