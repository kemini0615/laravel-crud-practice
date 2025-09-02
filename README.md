## Blade Templates

### 헬퍼 함수

-   `asset()` 함수는 다큐먼트 루트인 `public` 폴더에 대한 절대 경로를 반환한다.
-   `route()` 함수는 경로를 직접 입력하지 않고, '라우트의 이름'으로 절대 경로를 반환한다.

### 디렉티브

-   `@yield()`는 레이아웃 템플릿에서 동적인 컨텐츠를 삽입할 때 사용한다.
-   `@extends()`는 레이아웃 템플릿을 상속 및 확장할 때 사용한다.
-   `@section()`는 레이아웃 템플릿에 삽입할 컨텐츠를 정의할 때 사용한다.

## Commands

-   `php artisan make:controller <controller-name> -r`

    -   리소스 컨트롤러를 생성한다.
    -   리소스 컨트롤러는 리소스에 대한 CRUD 작업을 위한 표준화된 컨트롤러로, 다음과 같은 7가지 메소드를 기본으로 제공한다.
    -   `index()`, `create()`, `store()`, `show()`, `edit()`, `update()`, `destroy()`

-   `php artisan route:list`
    -   현재 등록된 모든 라우트에 대한 정보를 확인한다.
