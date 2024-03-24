# バックエンド設計書（PHP, Laravel, MySQL）

## 1. データベースの設計

**テーブル名:** json_data
**カラム:**
id (integer) : 主キー、自動インクリメント  
user_id (integer) : 外部キー、ユーザーIDを参照  
data (json) : JSONデータを保存するカラム  
created_at (timestamp) : データ作成日時  
updated_at (timestamp) : データ更新日時  

## 2. モデルの作成

**モデル名:** JsonData
テーブルとのマッピングを行い、必要なプロパティとメソッドを定義する。
**リレーションシップ:** JsonDataモデルは、Userモデルと belongsTo の関係を持つ。

## 3. マイグレーションファイルの作成

json_dataテーブルを作成するためのマイグレーションファイルを作成し、テーブルの構造を定義する。

## 4. コントローラーの作成

**コントローラ名:** JsonDataController

**主なアクション:**  
**store :** JSONデータを受け取り、データベースに保存する。ログインしているユーザーのIDを外部キーとして設定する。  
**show :** 指定されたIDのJSONデータをデータベースから取得し、レスポンスとして返す。ただし、ログインしているユーザーが所有するデータのみ取得できる。

## 5. ルーティングの設定

HTTP POSTリクエストで/api/json-dataにアクセスした際に、JsonDataController@storeアクションを実行する。  
HTTP GETリクエストで/api/json-data/{id}にアクセスした際に、JsonDataController@showアクションを実行する。  

上記の設計書に基づいて、以下の実装例を示します。

**1. マイグレーションファイル:**

```php
<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJsonDataTable extends Migration
{
    public function up()
    {
        Schema::create('json_data', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->json('data');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('json_data');
    }
}
```

**2. モデル:**

```php
<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JsonData extends Model
{
    use HasFactory;

    protected $table = 'json_data';

    protected $fillable = [
        'user_id',
        'data'
    ];

    protected $casts = [
        'data' => 'array'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
```

**コントローラー:**

```php
<?php
namespace App\Http\Controllers;

use App\Models\JsonData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JsonDataController extends Controller
{
    public function store(Request $request)
    {
        $jsonData = JsonData::create([
            'user_id' => Auth::id(),
            'data' => $request->json()->all(),
        ]);

        return response()->json($jsonData, 201);
    }

    public function show($id)
    {
        $jsonData = JsonData::where('id', $id)->where('user_id', Auth::id())->first();

        if ($jsonData) {
            return response()->json($jsonData);
        } else {
            return response()->json(['message' => 'Not found'], 404);
        }
    }
}
```

**4. ルーティングの設定:**

```php
<?php
use App\Http\Controllers\JsonDataController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->group(function () {
    Route::post('/json-data', [JsonDataController::class, 'store']);
    Route::get('/json-data/{id}', [JsonDataController::class, 'show']);
});
```
