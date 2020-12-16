<html>
<meta charset="utf-8"/>
<head><title>kanjinumbers.php</title></head>
<body>
アラビア漢字変換フォーム
<form action="number2kanji.php" method="post">
  <table border="1">
    <tr>
      <td>アラビア数字から漢字に変換</td>
      <td><input type="text" name="name"></td>
      <td colspan="2" align="center">
        <input type="submit" value="変換">
      </td>
    </tr>
  </table>
</form>
<form action="kanji2number.php" method="post">
  <table border="1">
    <tr>
      <td>漢字からアラビア数字に変換</td>
      <td><input type="text" name="name"></td>
      <td colspan="2" align="center">
        <input type="submit" value="変換">
      </td>
    </tr>
  </table>
</form>
</body>
</html>
