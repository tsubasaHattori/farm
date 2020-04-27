@extends('layouts.app')

@section('style')
<style>
  .write {
    font-size: 25px;
  }

  .message {
    margin-top: 30px;
  }

  .my-message {
    text-align: right;
  }

  .writer .fa{
    margin-right: 10px;
  }

  .fa-trash {
    cursor: pointer;
    color: #CC3333;
  }

  .my-message .content-line {
    width: 70%;
    text-align: right;
    margin: 1em 0 1em auto;
  }

  .others-message .content-line {
    width: 70%;
    margin: 1em 0 1em 0;
  }

  .content-line .content-box,  .content-line .content-box-null {
    display: inline-block;
    margin-left: 10px;
    border-radius: 8px;
  }

  .my-message .content-line .content-box {
    color: #565656;
    background: #66FF99;
    box-shadow: 0px 0px 0px 9px #66FF99;
    text-align: left;
  }

  .others-message .content-line .content-box {
    color: #565656;
    background: #ffeaea;
    box-shadow: 0px 0px 0px 9px #ffeaea;
  }
</style>

@endsection

@section('script')
<script type="text/javaScript">
  function Jump() {
      location.href = "#jumpto";
  }

  function deleteMessage(formName, url, method)
  {
    if(!window.confirm('本当に削除しますか？')){
      window.alert('キャンセルされました');
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
</script>
@endsection

@section('content')
<div onload="Jump()" class="container">
  <hr width = "100%">
  <div class="messages-block">
    @foreach ($messages as $message)
      <form name="deleteForm" action="/home/delete/{{$message['id']}}" method="POST">
      {{ csrf_field() }}
        <div @if($message['user_id'] == $user['id']) class="message my-message" @else class="message others-message" @endif>
          <div class="upper-line">
            <span class="writer">
              @if (!$message['is_deleted'] && $message['user_id'] == $user['id'])
              <i class="fa fa-trash fa-lg" onclick="return deleteMessage('deleteForm', '/home/delete/{{$message['id']}}', 'POST');"></i>
              @endif
              {{ $message['name'] }}
            </span>
          </div>
          <div class="content-line">
            @if ($message['is_deleted'])
            <span class="content-box-null">
              <span class="content">メッセージが削除されました</span>
            </span>
            @else
            <span class="content-box">
              <span class="content">{{ $message['content'] }}</span>
            </span>
            @endif
          </div>
        </div>
      </form>
    @endforeach
  </div>

  <hr width = "100%"><center>
  <p class="write" name="jumpto">書き込み</p>
  <table border="0" width="640">
    <tr>
      <td colspan="2" width="100%">
        <form action="/home/store" method="POST">
        @csrf
            内容<br>
            <textarea name="content" id="textfield1" style="width: 100%; height: 80px;" requred></textarea>
            <!-- <input type="text" name="content" size="50" id="textfield1" required><br> -->
            <br>
            <input type="submit" value="投稿" />
          </font>
        </form>
        <script type="text/javascript">
        document.getElementById('textfield1').focus();
        </script>
      </td>
    </tr>
  </table>
  <hr width = "100%"></center>
</div>
@endsection
