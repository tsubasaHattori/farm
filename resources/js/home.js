$(function() {

    function Jump() {
        location.href = "#jumpto";
    }

    function deleteMessage(formName, url, method)
    {
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

    $('.fa-trash').click(function() {
        console.log(123);
    });

});
