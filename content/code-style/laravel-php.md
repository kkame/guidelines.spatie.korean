# Laravel & PHP Style Guide

- [About Laravel](#about-laravel)
- [General PHP Rules](#general-php-rules)
- [Docblocks](#docblocks)
- [If statements](#if-statements)
- [Ternary operators](#ternary-operators)
- [Comments](#comments)
- [Configuration](#configuration)
- [Artisan commands](#artisan-commands)
- [Routing](#routing)
- [Controllers](#controllers)
- [Views](#views)
- [Validation](#validation)
- [Blade templates](#blade-templates)
- [Authorization](#authorization)
- [Translations](#translations)
- [Naming classes](#naming-classes)

## About Laravel

무엇보다도 Laravel은 사용자가 Laravel이 의도한대로 사용할 때 가장 큰 가치를 제공합니다. 무언가를 하기 위한 문서화 된 방법이 있다면 그것을 따르십시오. 당신이 다른 방식으로 무언가를 하려고 할 때, *왜* 당신이 표준을 따르지 않았는 지에 대한 정당성을 확인하십시오.

## 일반적인 PHP Rules

코드 스타일은 [PSR-1](http://www.php-fig.org/psr/psr-1/)과 [PSR-2](http://www.php-fig.org/psr/psr-2/)를 따라야합니다. 일반적으로 말하자면, 공개적으로 노출하지 않는 모든 문자열은 camelCase를 사용해야합니다. 이에 대한 자세한 예제는 해당 섹션의 가이드 전체에 걸쳐 있습니다.

## Docblocks

타입 힌트를 충분히 입력 할 수있는 메서드에는 docblock을 사용하지 마십시오. (설명을 따로 해야 할 필요가 없는 한)

메소드 시그니쳐 자체보다 많은 컨텍스트를 제공 할 때만 설명을 추가하십시오. 설명을 작성할 땐 마침표를 사용하여 완전한 문장을 작성하십시오.

```php
// Good
class Url
{
    public static function fromString(string $url): Url
    {
        // ...
    }
}

// Bad: 메서드가 모든 것을 표현하고 있으며 설명이 중복됩니다.
class Url
{
    /**
     * Create a url from a string.
     *
     * @param string $url
     *
     * @return \Spatie\Url\Url
     */
    public static function fromString(string $url): Url
    {
        // ...
    }
}
```

항상 정규화 된 클래스 이름을 docblock에 사용하십시오.

```php
// Good

/**
 * @param string $url
 *
 * @return \Spatie\Url\Url
 */

// Bad

/**
 * @param string $foo
 *
 * @return Url
 */
```

현재로서는 클래스 변수에 대해 타입힌트를 처리 할 수 있는 방법이 없으므로 클래스 변수에 대한 docblock이 필요합니다. 마
`역자주: 이 기능은 php7.4에서 추가될 예정이므로 아마 그 이후에는 주석보다는 코드를 통해 관리하는 것이 권장 될 것으로 예상됩니다`

```php
// Good

class Foo
{
    /** @var \Spatie\Url\Url */
    protected $url;

    /** @var string */
    protected $name;
}

// Bad

class Foo
{
    protected $url;
    protected $name;
}
```

가능한 경우 docblock은 한 줄로 작성해야합니다.

```php
// Good

/** @var string */
/** @test */

// Bad

/**
 * @test
 */
```

변수에 여러 유형이있는 경우 가장 일반적으로 발생하는 유형이 첫 번째여야합니다.

```php
// Good

/** @var \Spatie\Goo\Bar|null */

// Bad

/** @var null|\Spatie\Goo\Bar */
```

## 삼항 연산자

삼항 연산자의 모든 부분은 정말 짧은 표현이 아니라면 해당 행에 있어야합니다.

```php
// Good
$result = $object instanceof Model
    ? $object->name
    : 'A default value';

$name = $isFoo ? 'foo' : 'bar';

// Bad
$result = $object instanceof Model ?
    $object->name :
   'A default value';
```

## If statements

항상 중괄호를 사용하십시오.

```php
// Good
if ($condition) {
   ...
}

// Bad
if ($condition) ...
```

## Comments

주석은 의미가 잘 드러나게 하는 코드를 사용하여 가능한 사용하지 말아야 합니다. 주석을 사용해야 할 경우 다음과 같이하십시오.

```php
// 한 줄 주석 앞에 공백이 있어야합니다.

/*
 * 설명을 많이해야하는 경우 주석 블록을 사용할 수 있습니다. 
 * 첫 줄에 * 표시가 있는지 확인하십시오. 
 * 주석 블록은 3 줄 길이이거나 이전 줄보다 3 자 짧을 필요는 없습니다.
 */
```

## 공백

전달하고자 하는 것이 살아있어야 합니다. 일반적으로 한 줄에 해당하는 작업 시퀀스가 ​​아니라면 항상 문장 사이에 빈 줄을 추가하십시오. 
이것은 강제하는 것은 아니며, 맥락이 잘 드러나게 하는 것이 더 중요합니다.

```php
// Good
public function getPage($url)
{
    $page = $this->pages()->where('slug', $url)->first();

    if (! $page) {
        return null;
    }

    if ($page['private'] && ! Auth::check()) {
        return null;
    }

    return $page;
}

// Bad: 모든 것이 너무 붙어 있습니다.
public function getPage($url)
{
    $page = $this->pages()->where('slug', $url)->first();
    if (! $page) {
        return null;
    }
    if ($page['private'] && ! Auth::check()) {
        return null;
    }
    return $page;
}
```

```php
// Good: 한 줄의 동일한 작업 시퀀스입니다.
public function up()
{
    Schema::create('users', function (Blueprint $table) {
        $table->increments('id');
        $table->string('name');
        $table->string('email')->unique();
        $table->string('password');
        $table->rememberToken();
        $table->timestamps();
    });
}
```

대괄호 `{}`사이에 빈 줄을 추가하지 마십시오.

```php
// Good
if ($foo) {
    $this->foo = $foo;
}

// Bad
if ($foo) {

    $this->foo = $foo;

}
```

## Configuration

환경설정 파일은 kebab-case를 사용해야합니다.

```
config/
  pdf-generator.php
```

환경설정의 키는 snake_case를 사용해야합니다.

```php
// config/pdf-generator.php
return [
    'chrome_path' => env('CHROME_PATH'),
];
```

환경설정 파일 외부에서 `env` 헬퍼를 사용하지 마십시오. 위와 같이 `env` 변수에서 환경설정 값을 만듭니다.

## Artisan commands

Artisan에게 주어진 이름은 모두 케밥 케이스이어야합니다.

```bash
# Good
php artisan delete-old-records

# Bad
php artisan deleteOldRecords
```

커맨드는 항상 결과가 무엇인지에 대한 피드백을 제공해야합니다. 최소한 `handle` 메소드는 모두 잘 처리되었다는 것을 끝에 코멘트로 내보내야 합니다.

```php
// in a Command
public function handle()
{
    // do some work

    $this->comment('All ok!');
}
```

가능한 경우 서술적인 성공 메시지를 사용하십시오. 예: `오래된 기록이 삭제되었습니다.`

## Routing

공개 URL은 케밥 케이스를 사용해야합니다.

```
https://spatie.be/open-source
https://spatie.be/jobs/front-end-developer
```

라우트 이름은 camelCase를 사용해야합니다.

```php
Route::get('open-source', 'OpenSourceController@index')->name('openSource');
```

```html
<a href="{{ route('openSource') }}">
    Open Source
</a>
```

모든 라우트에는 http 동사가 있으므로 라우트를 정의 할 때 동사를 먼저 넣어야합니다. 이것은 라우트 그룹을 매우 읽기 쉽게 만듭니다. 다른 라우트 옵션은 그 다음에 와야합니다.

```php
// good: 모든 http 동사가 먼저옵니다.
Route::get('/', 'HomeController@index')->name('home');
Route::get('open-source', 'OpenSourceController@index')->middleware('openSource');

// bad: http 동사를 쉽게 찾을 수 없습니다 
Route::name('home')->get('/', 'HomeController@index');
Route::middleware('openSource')->get('OpenSourceController@index');
```

라우트 파라메터는 camelCase를 사용해야합니다.

```php
Route::get('news/{newsItem}', 'NewsItemsController@index');
```

url이 빈 문자열이 아니라면 경로 URL은 `/`로 시작하면 안됩니다.

```php
// good
Route::get('/', 'HomeController@index');
Route::get('open-source', 'OpenSourceController@index');

//bad
Route::get('', 'HomeController@index');
Route::get('/open-source', 'OpenSourceController@index');
```

## Controllers

리소스를 제어하는 ​​컨트롤러는 리소스의 복수 명사를 사용해야합니다.

```php
class PostsController
{
    // ...
}
```

컨트롤러를 단순하게 유지하고 기본 CRUD 키워드 (`index`, `create`, `store`, `show`, `edit`, `update`, `destroy`)를 유지하십시오. 다른 작업이 필요한 경우 새 컨트롤러로 분할하십시오.

다음 예제에서 우리는 `PostsController@favorite`와 `PostsController@unfavorite`를 가질 수 있습니다. 아니면 별도의 `FavoritePostsController`로 추출 할 수 있습니다.

```php
class PostsController
{
    public function create()
    {
        // ...
    }

    // ...

    public function favorite(Post $post)
    {
        request()->user()->favorites()->attach($post);

        return response(null, 200);
    }

    public function unfavorite(Post $post)
    {
        request()->user()->favorites()->detach($post);

        return response(null, 200);
    }
}
```

여기서 우리는 기본 CRUD 단어 `create`와 `destroy`로 돌아갑니다.

```php
class FavoritePostsController
{
    public function create(Post $post)
    {
        request()->user()->favorites()->attach($post);

        return response(null, 200);
    }

    public function destroy(Post $post)
    {
        request()->user()->favorites()->detach($post);

        return response(null, 200);
    }
}
```

이것은 강제로 지켜야 할 필요가없는 느슨한 지침입니다.

## Views

뷰 파일은 camelCase를 사용해야합니다.

```
resources/
  views/
    openSource.blade.php
```

```php
class OpenSourceController
{
    public function index() {
        return view('openSource');
    }
}
```

## Validation

모든 커스텀 유효성 검사 규칙은 snake_case를 사용해야합니다.

```php
Validator::extend('organisation_type', function ($attribute, $value) {
    return OrganisationType::isValid($value);
});
```

## Blade Templates

4 개의 공백을 사용하여 들여 쓰기하십시오.

```html
<a href="/open-source">
    Open Source
</a>
```

제어문 뒤에 공백을 추가하지 마십시오.

```html
@if($condition)
    Something
@endif
```

## Authorization

정책(policies)은 camelCase를 사용해야합니다.

```php
Gate::define('editPost', function ($user, $post) {
    return $user->id == $post->user_id;
});
```

```html
@can('editPost', $post)
    <a href="{{ route('posts.edit', $post) }}">
        Edit
    </a>
@endcan
```

표준 CRUD 단어를 사용하여 기능(abilities)에 이름을 붙이십시오. 한가지 예외 : `show`를 `view`로 대체하십시오. 서버가 리소스를 보여주고 사용자가 이것을 봅니다.

## Translations

번역은 `__` 함수로 렌더링되어야합니다. 블레이드 뷰와 일반 PHP 코드에서 모두 `__`을 사용할 수 있기 때문에 블레이드 뷰에서 `@lang`을 사용하는 것이 더 좋습니다. 다음은 그 예입니다.

```php
<h2>{{ __('newsletter.form.title') }}</h2>

{!! __('newsletter.form.description') !!}
```

## Naming Classes

이름 짓기는 종종 프로그래밍에서 더 어려운 것 중 하나로 간주됩니다. 그래서 우리는 클래스 명명에 대한 몇 가지 고급 지침을 설정했습니다.

### Controllers

일반적으로 컨트롤러는 해당 리소스의 복수 형식과 `Controller`접미사로 이름을 짓습니다. 이는 종종 동일한 이름의 모델과의 충돌을 피하기위한 것입니다.

예 : `UsersController` 또는 `EventDaysController`

When writing non-resourceful controllers you might come across invokable controllers that perform a single action. These can be named by the action they perform again suffixed by `Controller`.

리소스가 아닌 컨트롤러를 작성할 때 단일 액션을 수행하는 호출 가능한 컨트롤러를 만날 수 있습니다. 이것들은 `Controller` 라는 접미사와 수행되는 작업에 맞게 이름을 지을 수 있습니다.

예 : `PerformCleanupController`

### Resources (and transformers)

Eloquent 리소스와 Fractal 트랜스포머는 둘 다 `Resource` 또는 `Transformer`로 끝나는 복수의 리소스입니다. 이는 모델과의 충돌을 피하기위한 것입니다.

### Jobs

작업의 이름은 행동을 설명해야합니다.

예 : `CreateUser` 또는`PerformDatabaseCleanup`

### Events

이벤트는 종종 실제 이벤트 전후에 발생합니다. 이때 이벤트들의 이름은 사용 된 시제에 맞게 아주 분명히 해야합니다.

예 : 액션이 완료되기 전에 `ApprovingLoan`, 액션이 완료된 후 `LoanApproved` 가됩니다.

### Listeners

리스너는 들어오는 이벤트를 기반으로 작업을 수행합니다. 그들의 이름은 그 동작을 `Listener` 접미사로 반영해야합니다. 처음에는 이상하게 보일 수 있지만 작업과의 충돌을 피할 수 있습니다.

예 : `SendInvitationMailListener`

### Mailables

또다시 이름의 충돌을 피하기 위해 우리는 `Mail`을 mailables의 접미사로 사용합니다. 이벤트, 행동 또는 질문을 전달하는 데 자주 사용됩니다.

예 : `AccountActivatedMail` 또는 `NewEventMail`
