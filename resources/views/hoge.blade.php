<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Hoge</title>
    </head>
    <body>
      <div align="center"><center>
        <table border="0" width="640">
          <tr>
            <td colspan="2" width="100%">
              <font size="3">■お小遣い帳</font><br>
            </td>
          </tr>
        </table>

        <br>
        <hr width = "640">
        <br>

        <table border="0" width="640">
          <tr>
            <td colspan="2" width="100%">
              <form action="" method="" name="hogeForm">
                <font size = "2">
                  入金額<br>
                  <input type="text" name="value" size="50" id="textfield1"><br>
                  <br>
                  内容<br>
                  <input type="text" name="text" size="50" id="textfield2"><br>
                  <br>
                  <input type="submit" value="実行" />
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
        <br>
      </center></div>
    </body>
</html>