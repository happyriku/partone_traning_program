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

### 102-mysqlのデーバーベース一覧の表示方法

```bash


```

### mysql -h localhost -P 10202 -u uzone -ppassword uzone
### ユーザ名uzone, password: uzone, localhostでport10202からmysqlにアクセスする

### show database;
### databaseの中身を表示する

### SHOW TABLES;
### databaseに含まれるtableを表示する

### show table status;
### tableの名前以外
