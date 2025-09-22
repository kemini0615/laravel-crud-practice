## 블레이드 템플릿

### 헬퍼 함수

-   `asset()` 함수는 다큐먼트 루트인 `/public/` 디렉토리에 대한 URL(절대 경로)을 반환한다.
-   `route()` 함수는 '라우트의 경로'를 직접 입력하지 않고, '라우트의 이름'으로 절대 경로를 반환한다.
-   `request()` 함수는 현재의 HTTP 요청 객체(`Illuminate\Http\Request`)를 반환한다.

### 밸리데이션

-   `$errors` 객체는 밸리데이션 에러가 발생했을 때, 해당 정보를 갖고 있는 객체.
-   `old()` 헬퍼 함수는 밸리데이션 에러가 발생했을 때, 이전에 입력한 값을 반환한다.

### 디렉티브

-   `@yield()`는 레이아웃 템플릿에서 동적인 컨텐츠를 삽입할 때 사용한다.
-   `@extends()`는 레이아웃 템플릿을 상속 및 확장할 때 사용한다.
-   `@section()`는 레이아웃 템플릿에 삽입할 컨텐츠를 정의할 때 사용한다.
-   `@csrf`는 폼에 CSRF 토큰을 추가할 때 사용한다.
-   `@foreach ($items => $item)`는 **루프(Loop)**다.
    -   루프 내부에서 `{{ $loop->iteration }}`를 통해서 **1부터 시작하는** 반복 회수를 반환할 수 있다.
-   `@method()`는 리퀘스트의 메소드를 `PUT`, `PATCH`, `DELETE` 등으로 설정할 때 사용한다.
-   `@selected()`는 `<option>` 태그에 조건부로 `selected` 속성을 추가할 때 사용한다.

## PHP & Laravel

### 헬퍼 함수

-   `storage_path()` 함수는 `/storage/` 디렉토리에 대한 절대 경로를 반환한다.
-   `public_path()` 함수는 다큐먼트 루트인 `/public/` 디렉토리에 대한 파일 시스템 경로(절대 경로)를 반환한다.

### 라우트

-   `Route::resource()` 메소드는 리소스 컨트롤러에 대한 기본적인 7가지 라우트를 처리한다.
    -   리소스 컨트롤러에 새로운 라우트를 추가할 수 있지만, 반드시 `resource()` 메소드보다 먼저 호출되어야 한다.

### 컨트롤러

-   `compact()` 함수는 변수 이름을 문자열로 받아, 그 이름과 동일한 키와 값을 가진 연관 배열(associative array)을 만들어 반환한다.

-   컨트롤러 액션 메소드의 파라미터에 **모델 클래스**로 **타입 힌트**를 설정(`Customer $customer`)하면, Laravel이 URL에 입력된 동적인 값(예: id)을 활용해 해당 모델의 인스턴스를 찾아서 자동으로 할당해주는 '**라우트 모델 바인딩(Route Model Binding)**'이 발생한다.
    -   **모델 바인딩**은 기본적으로 '소프트 딜리트' 처리된 데이터를 조회하지 않는다.

### 리퀘스트

1. `Request (Illuminate\Http\Request)` 클래스

-   유저의 요청(리퀘스트)을 처리하기 위한 클래스.
-   현재의 모든 HTTP 요청 정보(GET, POST, 파일, 헤더 등)를 담고 있다.
-   `$request->input('key')`: GET(쿼리 스트링), POST(리퀘스트 바디) 데이터를 가져오는 메소드로, 가장 권장되는 방식이다.
    -   간단하게 `$request->key`를 사용하는 경우도 많다.
-   `$request->query('key')`: GET(쿼리 스트링) 데이터만 가져온다.
-   `$request->post('key')`: POST(리퀘스트 바디) 데이터만 가져온다.
    -   최신 버전의 Laravel(11+)에서는'타입 세이프(type-safe) 메소드'의 사용을 권장한다.
    -   `$request->string('key')`, `$request->integer('key')`, `$request->boolean('key')` 등
-   `$request->all()`: GET, POST 데이터를 모두 배열로 가져온다.

2. `FormRequest (Illuminate\Foundation\Http\FormRequest)` 클래스

-   `php artisan make:request <request-name>` 커맨드를 통해 생성한 확장 클래스.
-   유효성 검사(Validation)와 권한 검사(Authorization)를 컨트롤러에서 분리한다.
-   `FormRequest::rules()`: 밸리데이션 규칙을 정의한다.
-   `FormRequest::authorize()`: 이 요청을 수행할 권한이 있는지 검사한다.

## 커맨드

-   `php artisan make:controller <controller-name> -r`

    -   리소스 컨트롤러를 생성한다.
    -   리소스 컨트롤러는 리소스에 대한 CRUD 작업을 위한 표준화된 컨트롤러로, 다음과 같은 7가지 메소드를 기본으로 제공한다.
    -   `index()`, `create()`, `store()`, `show()`, `edit()`, `update()`, `destroy()`

-   `php artisan route:list`

    -   현재 등록된 모든 라우트에 대한 정보를 확인한다.

-   `php artisan make:request <request-name>`

    -   폼 밸리데이션을 위한 사용자 정의 리퀘스트 클래스를 생성한다.
    -   컨트롤러 외부에서 복잡한 밸리데이션 로직을 추가할 수 있다.
    -   컨트롤러의 액션 메소드에서 리퀘스트 클래스에 대한 적절한 타입 힌트를 통해 밸리데이션을 자동으로 수행할 수 있다.

-   `php artisan make:model <model-name> -m`

    -   모델 클래스를 생성한다.
    -   모델 클래스는 DB와의 인터페이스 역할을 하는 클래스다.
    -   `-m` 옵션으로 마이그레이션을 함께 생성한다.

-   `php artisan make:migration <migration-name> --table=<table-name>`

    -   기존의 테이블을 수정하기 위한 마이그레션 파일을 생성한다.

-   `php artisan migrate`

    -   아직 실행되지 않은 마이그레이션 파일만 실행한다.
    -   새로운 테이블 추가, 기존 테이블에 새로운 칼럼 추가 등.
    -   이미 실행된 마이그레이션 파일은 다시 실행하지 않는다.

-   `php artisan migrate:refresh`

    -   지금까지 실행된 모든 마이그레이션을 롤백한 다음, 다시 실행한다.
    -   마이그레이션 클래스의 `down()`, `up()` 메소드를 순서대로 실행하기 때문에, `down()` 메소드가 제대로 정의돼야 한다.
    -   DB 초기화 없이, 마이그레이션 재실행.

-   `php artisan migrate:fresh`

    -   모든 테이블을 삭제(drop)한 다음, 마이그레이션을 처음부터 다시 실행한다.
    -   마이그레이션 클래스의 `down()` 메소드를 실행하는 것이 아니라, 테이블을 통째로 삭제한다.
    -   DB 완전 초기화

## DB

### DB 설정

-   Laravel의 기본 DB 설정은 `sqlite`.

    -   `.env` 파일을 통해서 DB 설정을 변경할 수 있다.

-   `MySQL 8.x` 이상에서 `root` 계정은 기본적으로 `auth_socket` 플러그인을 사용해 인증한다.

    -   `root`는 OS 루트 계정으로 터미널에서만 접속이 가능하다.

        ```bash
        sudo mysql -u root
        ```

    -   Laravel에서 `MySQL`에 접속할 때는 `root`가 아닌 새로운 계정을 만들어야 한다.

        ```sql
        CREATE USER '<user>'@'localhost' IDENTIFIED BY '<password>';
        GRANT ALL PRIVILEGES ON *.* TO '<user>'@'localhost';
        FLUSH PRIVILEGES;
        ```

### 파일 저장

-   파일을 업로드해서 저장할 때, 파일은 파일 시스템에 저장하고, 해당 파일의 경로를 DB에 저장하는 게 일반적이다.

-   외부에서 접근할 수 있는 파일(공개 파일)을 저장할 때는 크게 2가지 방법이 있다.
    1. `/storage/app/public/` 디렉토리에 파일을 저장하고, `/public/` 디렉토리와 심볼릭 링크를 설정하기.
        - 이 방법은 서버 환경에 따라 제대로 동작하지 않을 수 있다.
        - `php artisan storage:link`
    2. 처음부터 `/public/` 디렉토리를 스토리지로 사용하기.
        - 설정을 변경할 필요가 있다.
        - `/config/filesystems.php`에서 `disks.public.root`를 `storage_path()` 헬퍼 함수가 아닌, `public_path()` 헬퍼 함수를 사용해서 스토리지의 경로를 변경한다.

### Soft Deletes

-   DB에서 데이터를 직접 삭제하지 않고 `delete_at` 칼럼만 조작하여, 데이터를 삭제 **취급**한다.
    -   `deleted_at` 칼럼이 `NULL`이면, 삭제된 데이터 취급.
    -   `deleted_at` 칼럼에 값이 존재하면, 삭제되지 않은 데이터 취급.
-   Migration 파일에서 `$table->softDeletes()` 메소드를 통해 '소프트 딜리트'를 위한 `deleted_at` 칼럼을 생성한다.
-   `Eloquent` 모델 클래스에서 `SoftDeletes` 트레이트를 사용한다.
    -   `onlyTrashed()` 메소드를 통해, '소프트 딜리트' 처리된 데이터만을 가져올 수 있다.
