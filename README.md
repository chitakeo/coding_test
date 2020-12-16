# coding_test
コーディングテスト用リポジトリ

# ファイル
kanjinumbers.php
ルートのページ

number2kanji.php
アラビア数値を漢字に変換した結果を表示するページ

kanji2number.php
漢字をアラビア数値に変換した結果を表示するページ

# kanji2number.php において入力が適切かどうかの判定
漢字をアラビア数値に変換できるかどうかは corrent_check() で判定している. 以下に変換できないパターンとそれを検知している部分(コードの行数)を書く

  1. 1文字目に壱~九以外の文字が含まれている場合. 例; 億二千万 (93, 94行目)
  2. 兆, 億, 万のそれぞれの文字が複数現れたり順番が入れ替わっている場合. 例; 八兆五兆, 壱万弐億 (101 ~ 103行目)
  3. アラビア数字における4桁区切りの中で、千, 百, 拾のそれぞれの文字が複数現れたり順番が入れ替わっている場合. 例; 八兆弐百五百億, 八兆弐百五千億 (107 ~ 109行目)
  4. アラビア数字に対応しない文字が含まれていた場合. 例; 5m六億台 (113, 114行目)
  5. 壱 ~ 九の文字が続けて出てくる場合. 例; 八壱拾 (118, 119行目)
  6. 兆, 億, 万の1つ後に兆, 億, 万, 千, 百, 拾の文字が出てくる場合. 例; 弐億百壱 (120, 121行目)
  7. 千, 百, 拾のいずれかの文字が続けて出てくる場合. 例; 弐億百壱 (122 ~ 125行目)
  
1~7の条件を全て満たさなかった入力が変換されるようになっている  



# 変換手順
number2kanji.php においてアラビア数値を漢字に変換する手順

入力文字を左から一文字ずつ分割し、それに対して number2kanji() を実行し, 返り値をつないでいくことで変換結果を構築している

number2kanji() の仕様は以下のとおり
返り値は $result

  1. 数字を確認し、対応する漢字を $result に入れる(8~26行目)
  2. 桁数を確認し、4で割ったあまりに対応する漢字を $result に追加(27~35行目)
  3. 桁数に対応する漢字を $result に追加(36~42行目)
  
kanji2number.php において漢字をアラビア数値に変換する手順 (kanji2number())

入力文字を左から一文字ずつアラビア文字に変換して足していく. 以下はその時の処理

  1. 壱 ~ 九の文字はアラビア数字に変換して(number()で行う) $tmp に代入する (84行目)
  2. 千, 百, 拾の文字は $tmp をそれぞれ 10, 100, 1000 倍にして　$tmp2 に足す その後 $tmp を0にする (50 ~ 61行目)
  3. 兆, 億, 万の文字は $tmp と $tmp2 をそれぞれ 10の12乗, 10の8乗, 10の4乗, 倍にして $result に足す その後 $tmp と $tmp2 を0にする(62 ~ 82行目)
  
全ての文字に対して処理を行ったら $result を返す
