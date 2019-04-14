# JavaScript Style Guide

- [Spacing and Indentation in Functions and Control Statements](#spacing-and-indentation-in-functions-and-control-statements)
- [Spacing and Indentation in Objects and Arrays](#spacing-and-indentation-in-objects-and-arrays)
- [Line Length](#line-length)
- [Quotes](#quotes)
- [Semicolons](#semicolons)
- [Variable Assignment](#variable-assignment)
- [Variable Names](#variable-names)
- [Comparisons](#comparisons)
- [Function Keyword vs. Arrow Functions](#function-keyword-vs-arrow-functions)
- [Arrow Function Parameter Brackets](#arrow-function-parameter-brackets)
- [Object and Array Destructuring](#object-and-array-destructuring)
- [Vue templates](#vue-templates)

## ESLint

이 안내서는 기본 ESLint 구성 파일과 함께 사용해야합니다. 이 파일은 자체 저장소가 있으며 npm에서 사용할 수 있습니다.

[https://github.com/spatie/eslint-config-spatie](https://github.com/spatie/eslint-config-spatie)

```
yarn add --dev eslint-config-spatie
```

대부분의 프로젝트는`package.json`에서 사용할 수있는 린트 스크립트를 가지고 있습니다.

```
eslint resources/assets/js --ext .js,.vue --fix && exit 0
```

## Code Style

### 함수와 제어문에서의 여백과 들여 쓰기

코드는 4 칸으로 들여 쓰기해야합니다.

```js
// Good
function greet(name) {
    return `Hello ${name}!`;
}

// Bad, only 2 spaces.
function greet(name) {
  return `Hello ${name}!`;
}
```

기호 또는 키워드의 주위 공백에 관해서, 경험적으로 유용한 법칙은 다음과 같습니다. 이 섹션의 모든 내용은 ESLint에서 처리해야합니다.

```js
// Good
if (true) {
    // ...
} else {
    // ...
}

// Bad, needs more spaces.
if(true){
    // ...
}else{
    // ...
}
```

중위 연산자에는 숨 쉴 공간이 필요합니다.

```js
// Good
const two = 1 + 1;

// Bad, needs more spaces.
const two = 1+1;
```

여는 중괄호는 항상 해당 문이나 선언 (*하나의 진정한 중괄호 스타일*이라고도 함)과 같은 줄에 있어야합니다.

```js
// Good
if (true) {
    // ...
}

// Bad
if (true)
{
    // ...
}
```

이름이 있는 함수는 매개 변수 앞에 공백이 없어야 합니다. 이름이 없다면 하나의 공백이 필요합니다.

```js
// Good
function save(user) {
    // ...
}

// Bad, 매개 변수 앞에 공백이 없어야합니다.
function save (user) {
    // ...
}
```

```js
// Good
save(user, function (response) {
    // ...
});

// Bad, 익명 함수는 매개 변수 앞에 공백이 필요합니다.
save(user, function(response) {
    // ...
});
```

### 객체와 배열에서의 여백과 들여 쓰기

객체와 배열에는 괄호와 대괄호 사이에 공백이 있어야합니다. 객체 또는 다른 배열을 포함하는 배열은 대괄호 사이에 공백이 없어야합니다. 다중 행 객체 및 배열에는 후행 쉼표가 필요합니다.

```js
// Good
const person = { name: 'Sebastian', job: 'Developer' };

// Bad, 괄호 사이에는 공백이 없어야합니다.
const person = {name: 'Sebastian', job: 'Developer'};
```

```js
// Good
const person = {
    name: 'Sebastian',
    job: 'Developer',
};

// Bad, 뒤에 오는 쉼표가 없습니다.
const person = {
    name: 'Sebastian',
    job: 'Developer'
};
```

```js
// Good
const pairs = [['a', 'b'], ['c', 'd']];
const people = [{ name: 'Sebastian' }, { name: 'Willem' }];

// Bad, 배열에 배열이나 객체가 있으면 여분의 공백이 없어야합니다.
const pairs = [ ['a', 'b'], ['c', 'd'] ];
const people = [ { name: 'Sebastian' }, { name: 'Willem' } ];
```

### Line Length

행은 100자를 넘지 않는 것이 좋으며 반드시 120자는 넘지 않아야합니다 (ESLint에서는 강제하지 않습니다). 설명은 반드시 80자를 넘지 않아야합니다.

### Quotes

가능한 경우 홑 따옴표를 사용하십시오. 여러 줄 또는 보간이 필요한 경우 템플릿 문자열을 사용하십시오.

```js
// Good
const company = 'Spatie';

// Bad, 여기서 홑 따옴표를 사용할 수 있습니다.
const company = "Spatie";

// Bad, 여기서 홑 따옴표를 사용할 수 있습니다.
const company = `Spatie`;
```

```js
// Good
function greet(name) {
    return `Hello ${name}!`;
}

// Bad, 템플릿 문자열이 선호됩니다.
function greet(name) {
    return 'Hello ' + name + '!';
}
```

또한 html 템플릿 (또는 jsx와 관련하여)을 작성할 때는 가능하다면 새 라인에 여러 줄 템플릿을 시작하십시오.

```js
function createLabel(text) {
    return `
        <div class="label">
            ${text}
        </div>
    `;
}
```

### Semicolons

항상 사용하십시오.

### Variable Assignment

`let` 보다 `const`를 우선하십시오. 변수가 재 할당됨을 나타내기 위해서 `let` 만 사용하십시오. `var`을 절대로 사용하지 마십시오.

### Variable Names

일반적으로 변수 이름을 축약해서는 안됩니다.

```js
// Good
function saveUser(user) {
    localStorage.set('user', user);
}

// Bad, 블록이 커지면 약어를 추론하기 어렵습니다.
function saveUser(u) {
    localStorage.set('user', u);
}
```

단일 라인에서 사용되는 화살표 함수에서 컨텍스트가 충분히 명확하면 약어로 번잡함을 줄일 수 있습니다. 예를 들어, 아이템 컬렉션에서 `forEach`의 `map`을 호출하면, 파라미터가 컬렉션의 실질적인 변수 이름에서 파생 될 수있는 특정 타입의 아이템이라는 것이 확실합니다.

```js
// Good
function saveUserSessions(userSessions) {
    userSessions.forEach(s => saveUserSession(s));
}

// Ok, 하지만 꽤 번잡하다.
function saveUserSessions(userSessions) {
    userSessions.forEach(userSession => saveUserSession(userSession));
}
```

### Comparisons

변수 비교를 수행 할 때는 항상 트리플 이퀄(===)을 사용하십시오. 유형을 잘 모르는 경우 먼저 캐스트하십시오.

```js
// Good
const one = 1;
const another = "1";

if (one === parseInt(another)) {
    // ...
}

// Bad
const one = 1;
const another = "1";

if (one == another) {
    // ...
}
```

### Function Keyword vs. Arrow Functions

함수 선언은 function 키워드를 사용해야합니다.

```js
// Good
function scrollTo(offset) {
    // ...
}

// 여기에 화살표 함수를 사용하면 어떤 이점도 제공되지 않지만 `function` 키워드는 바로 이것이 함수임을 분명히합니다.
const scrollTo = (offset) => {
    // ...
};
```

쉽게 말하자면, 한 줄 함수도 화살표 구문을 사용할 수 있습니다. 여기에는 어려운 규칙이 없습니다.

```js
// Good
function sum(a, b) {
    return a + b;
}

// 짧고 간단한 방법이므로 한 줄로 채우는 것이 좋습니다.
const sum = (a, b) => a + b;
```

```js
// Good
export function query(selector) {
    return document.querySelector(selector);
}

// 이 것은 조금 더 길어서, 한 줄에 모든 것이 있는 데 약간 무거워 보입니다.
// 이전 예제와 달리 쉽게 파악 할 수 없습니다.
export const query = selector => document.querySelector(selector);
```

고차 함수는 가독성을 향상시킨다면 화살표 함수를 사용할 수 있습니다.

```js
function sum(a, b) {
    return a + b;
}

// Good
const adder = a => b => sum(a, b);

// Ok, 하지만 불필요할 정도로 복잡하다.
function adder(a) {
    return function (b) {
        return sum(a, b);
    };
}
```

익명 함수는 화살표 함수를 사용해야합니다.

```js
['a', 'b'].map(a => a.toUpperCase());
```

그들이 `this`에 접근 할 필요가 없다면.

```js
$('a').on('click', function () {
    window.location = $(this).attr('href');
});
```

함수를 순수하게 유지하고`this` 키워드의 사용을 제한하십시오.

객체 메소드는 약식 메소드 구문을 사용해야합니다.

```js
// Good
export default {
    methods: {
        handleClick(event) {
            event.preventDefault();
        },
    },
};

// Bad, `function` 키워드는 목적이 없습니다.
export default {
    methods: {
        handleClick: function (event) {
            event.preventDefault();
        },
    },
};
```

### Arrow Function Parameter Brackets

함수가 한 줄짜리이면 화살표 함수의 매개 변수 대괄호는 생략해야합니다.

```js
// Good
['a', 'b'].map(a => a.toUpperCase());

// Bad, 괄호가 번잡하다.
['a', 'b'].map((a) => a.toUpperCase());
```

화살표 함수에 자체 블록이있는 경우 매개 변수는 대괄호로 묶어야합니다.

```js
// Good, 이 스타일 가이드에 따르면
// 여기에 화살표 함수!
const saveUser = (user) => {
    //
};

// Bad
const saveUser = user => {
    //
};
```

고차 함수를 작성하는 경우에는 반환 된 함수에 중괄호가 있는 경우에도 괄호를 제거해야 합니다.

```js
// Good
const adder = a => b => {
    sum(a, b);
};

// Bad, 이 맥락에서 일관성이없는 것처럼 보입니다.
const adder = a => (b) => {
    sum(a, b);
};
```

### Object and Array Destructuring

Destructuring은 해당 키에 변수를 할당하는 것보다 선호됩니다.

```js
// Good
const [hours, minutes] = '12:00'.split(':');

// Bad, 불필요하게 자세한 정보를 제공하며,이 경우 추가 할당이 필요합니다.
const time = '12:00'.split(':');
const hours = time[0];
const minutes = time[1];
```

Destructuring는 환경 설정과 유사한 객체를 전달할 때 매우 유용합니다.

```js
function uploader({
    element,
    url,
    multiple = false,
    beforeUpload = noop,
    afterUpload = noop,
}) {
    // ...
}
```

### Vue templates

Vue 컴포넌트가 한 줄에 들어 가지 않는 많은 수의 프로퍼티가 (또는 리스너, 지시문 등) 있으면 모든 프로퍼티는 개별 줄에 넣어야 합니다. 모든 줄은 스페이스 4칸으로 들여쓰기해야합니다.  `>`로 닫을 때는 들여쓰지 않은 새로운 줄에서 닫는 태그를 사용한다.

```html
<template>
    <!-- Good -->
    <my-component myProp="value"><my-component>
</template>
```

```html
<template>
    <!-- Good -->
    <my-component
        v-if="shouldDisplay"
        myProp="value"
        @change="handleEvent"
    ></my-component>
</template>
```

```html
<template>
    <!-- Bad: 들여 쓰기가 틀렸습니다, `>`닫기가 올바르지 않습니다. -->
    <my-component
            v-if="shouldDisplay"
            myProp="value"
            @change="handleEvent">
    </my-component>
</template>
```

## Credits

이 스타일 가이드는 주로 [Airbnb JavaScript Style Guide](https://github.com/airbnb/javascript) 과 [Benjamin De Cock의 프론트 엔드 가이드 라인](https://github.com/bendc/frontend-guidelines)에서 영감을 얻은 것입니다.
