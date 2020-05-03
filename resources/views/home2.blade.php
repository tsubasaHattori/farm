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
        :users = users
        :initial-messages = messages>
    </component-message-form>
</div>
@endsection

@section('footer_script')
<script type="text/javaScript">

var home = new Vue({
    el: "#home-container",
    data: {
        authUser: @json($auth_user),
        messages: @json($messages),
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
    }
})
</script>
@endsection
