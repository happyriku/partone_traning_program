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
