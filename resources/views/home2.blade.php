@extends('layouts.app')
@section('title', 'Far-mer Home')

@section('style')
<link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endsection

@section('header_script')
<style>
    .scroll-button {
        position: fixed;
        right: 20px;
        bottom: 60px;
        opacity: 0.7;
    }
</style>
@endsection

@section('content')
<div id="home-container" class="container">
    <component-message-form
        :auth-user = authUser
        :users = users
        :initial-messages = messages
        :initial-message-map = messageMap
        @store="scrollEnd">
    </component-message-form>

    <button @click="scrollEnd" class="scroll-button"><i class="fa fa-arrow-down"></i>
</div>
@endsection

@section('footer_script')
<script type="text/javaScript">

var home = new Vue({
    el: "#home-container",
    data: {
        authUser: @json($auth_user),
        messages: @json($messages),
        messageMap: @json($messageMap),
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
