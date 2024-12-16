# Uzoneの会員登録・マイページ系APIを開発してみよう

## Mysqlの使い方

> 分からないところはMysql Developer Zoneで調べると良い

<br>

### 101-mysqlサーバーへのアクセスの仕方

```bash
# mysqlサーバーのホスト名称
HOSTNAME="localhost"
# mysqlサーバーのポート番号
PORT_NUMBER="10202"
# mysqlサーバーのユーザ-名
USERNAME="uzone"
# mysqlサーバーのユーザーに対するパスワード 
PASSWORD="password"
# mysqlサーバーのデータベース名
DATABASE_NAME="uzone"

mysql \
  -h $HOSTNAME \
  -P $PORTNUMBER \
  -u $USERNAME \
  -p$PASSWORD \
  $DATABASE_NAME
```

<br>

---

### 102-mysqlのデーターベース一覧の表示方法

```sql
SHOW DATABASES;
```

<br>

**一例**
```sql
MySQL [uzone]> SHOW DATABASES;
+--------------------+
| Database           |
+--------------------+
| information_schema |
| performance_schema |
| uzone              |
+--------------------+
3 rows in set (0.001 sec)
```

<br>

---

### 103-mysqlのデーターベースのテーブル一覧の表示方法
```sql
SHOW TABLES;
```

<br>

**一例**
```sql
MySQL [uzone]> SHOW TABLES;
+-------------------------------+
| Tables_in_uzone               |
+-------------------------------+
| admins                        |
| cache                         |
| cache_locks                   |
~~~
| wk_base_data                  |
+-------------------------------+
109 rows in set (0.002 sec)
```

> 名前以外の情報を表示させたい時は，`SHOW TABLE STATUS;`
<br>

---

### 104-mysqlのselect文の使い方
```sql
SELECT カラム名 FROM テーブル名;
```

<br>

**一例**
```sql
MySQL [uzone]> SELECT * FROM cars;
+------+----------+---------------+-----------------------------------------+--------+---------------------+---------------------+------------+------------+
| id   | maker_id | atrs_car_code | name                                    | status | created_at          | updated_at          | created_by | updated_by |
+------+----------+---------------+-----------------------------------------+--------+---------------------+---------------------+------------+------------+
|    1 |        1 | 1810          | 86                                      |      1 | 2024-12-13 17:39:19 | 2024-12-13 17:39:19 |      20000 |      20000 |
~~~

| 1026 |        2 | 6620          | NT100クリッパー                          |      1 | 2024-12-13 17:39:30 | 2024-12-13 17:39:30 |      20000 |      20000 |
+------+----------+---------------+-----------------------------------------+--------+---------------------+---------------------+------------+------------+
539 rows in set (0.006 sec)
```

<br>

**WHERE句** (検索方法)
```sql
--- 特定のカラム名の情報を取得したいときに利用する
SELECT カラム名1 FROM テーブル名 WHERE id = 値;
```

**limit句** (検索方法)
```sql
--- テーブルの数を制限して表示させたいときに利用する
SELECT カラム名1　FROM テーブル名 LIMIT 数字;
```

**ORDER BY句** (検索方法)
```sql
--- 取得した情報を昇順または降順で並べ替えたいときに利用する
SELECT カラム名1 FROM テーブル名 ORDER BY ソートキー;
```
> ソートキーは，列名または式を指定します。

**注意事項**
```sql
句の順番によってはエラーが発生します。
```
<br>

---