## 블레이드 템플릿

### 헬퍼 함수

-   `asset()` 함수는 다큐먼트 루트인 `public` 폴더에 대한 절대 경로를 반환한다.
-   `route()` 함수는 '라우트의 경로'를 직접 입력하지 않고, '라우트의 이름'으로 절대 경로를 반환한다.

### 밸리데이션

-   `$errors` 객체는 밸리데이션 에러가 발생했을 때, 해당 정보를 갖고 있는 객체.
-   `old()` 헬퍼 함수는 밸리데이션 에러가 발생했을 때, 이전에 입력한 값을 반환한다.

### 디렉티브

-   `@yield()`는 레이아웃 템플릿에서 동적인 컨텐츠를 삽입할 때 사용한다.
-   `@extends()`는 레이아웃 템플릿을 상속 및 확장할 때 사용한다.
-   `@section()`는 레이아웃 템플릿에 삽입할 컨텐츠를 정의할 때 사용한다.
-   `@csrf`는 폼에 CSRF 토큰을 추가할 때 사용한다.

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

## DB 설정

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
