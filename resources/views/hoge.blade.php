@extends('layouts.app')

<!-- <!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <title>Hoge</title>
    </head>
    <body> -->
    @section('content')
      <div align="center"><center>
        <table border="0" width="640">
          <tr>
            <td colspan="2" width="100%">
              <a href="/hoge" title="タイトル？"><font size="3">■家計簿</font></a>
            </td>
          </tr>
        </table>

        <br>
        <hr width = "640">
        <br>

        <table border="0" width="640">
          <tr>
            <td colspan="2" width="100%">
              <form action="/add" method="POST" name="hogeForm">
              @csrf
                <font size = "2">
                  <input type="radio" name="status" value=1 required>収入
                  <input type="radio" name="status" value=2>支出<br><br>
                  金額<br>
                  <input type="text" name="value" size="50" id="textfield1" required><br>
                  <br>
                  内容<br>
                  <input type="text" name="text" size="50" id="textfield2" required><br>
                  <br>
                  <input type="submit" value="保存" />
                </font>
              </form>
              <script type="text/javascript">
              document.getElementById('textfield1').focus();
              </script>
            </td>
          </tr>
        </table>

        <br>
        <hr width = "640">
            <table border="0" width="640">
              <tr>
                <td style="text-align: center;">収支</td>
                <td style="text-align: center;">内容</td>
                <td style="text-align: center;">金額</td>
                <td style="text-align: center;"><i class="fa fa-trash" aria-hidden="true"></i></td>
              </tr>
              @if(isset ($results))
              @foreach($results as $result)
                <tr>
                  <form action="/delete/{{$result['id']}}" method="POST" name="hogeForm">
                  {{ csrf_field() }}
                    @if($result['status'] == 1)
                    <td style="text-align: center;">+</td>
                    @else
                    <td style="text-align: center;">-</td>
                    @endif
                    <td style="text-align: center;">{{$result['saif_text']}}</td>
                    <td style="text-align: center;">{{$result['saif_money']}}</td>
                    <td style="text-align: center;"><input type="submit" value="削除"></td>
                  </form>
                </tr>
              @endforeach
              @endif
            </table>
        <br>
      </center></div>
    @endsection
    <!-- </body>
</html> -->
