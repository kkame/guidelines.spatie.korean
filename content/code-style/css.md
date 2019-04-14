# CSS Style Guide

- [Preprocessing](#preprocessing)
- [BEVM](#bevm)
- [DOM structure](#dom-structure)
- [Code style](#code-style)
- [File structure](#file-structure)
- [Inspiration](#inspiration)

## Preprocessing

우리는 [CSSNext](http://cssnext.io)와 함께 PostCSS를 사용하지만, 이 원칙은 거기에 있는 전처리기나 후처리기에 모두 적용됩니다.

## BEVM

일부 커스텀 악센트가 있는 BEM과 유사한 구문을 사용합니다. 'variation'은 [Chainable BEM modifiers](https://webuild.envato.com/blog/chainable-bem-modifiers/)에서 가져온 개념입니다.

우리는 다음과 같은 요소로 스타일을 정의하기위한 클래스만 사용합니다.

```css
.component                      /* Component */   
.component__element             /* Child */
.component__element__element    /* Grandchild */

.items                          /* Use plurals if possible */
.item                        

.-modifier                      /* Single property modifier, can be chained */

.component--variation           /* Standalone variation of a component */
.component__element--variation  /* Standalone variation of an element */

.helper-property                /* Generic helper grouped by type (eg. `align-right`, `margin-top-s`) */

.js-hook                        /* Script hook, not used for styling */
```

### .component 와 .component__element

```html
<div class="news">
```

- 재사용 가능한 단일 컴포넌트 또는 패턴
- 자식들(children)은 `__`으로 구분됩니다
- 모두 소문자이며 이름에 `-`를 포함 할 수 있습니다
- 3 단계 이상은 사용하지 마시요

```html
<div class="news">
    <div class="news__item">
        <div class="news__item__publish-date">
```     

컴포넌트 엘리멘츠로 표현하세요. `class = "team__item"` 대신에 `class = "team__member"` 사용을 고려하세요.

```html
<div class="team">
    <div class="team__member">
```   

가독성을 위해 복수형과 단수를 사용할 수 있습니다. `class = "members__member"` 대신에 `class = "member"`사용을 고려하세요.

```html
<div class="members">
    <div class="member">
```   

### .-modifier

```html
<div class="button -rounded -active">
```

```css
.button {
    &.-rounded {
        …  
    }

    &.-active {
        …
    }
}
```

- modifier는 컴포넌트의 간단한 프로퍼티만 변경하거나 프로퍼티를 추가합니다
- modifier는 **항상** 컴포넌트에 묶여 있으며, 독자적으로 작동하지 않습니다 ( "전역" modifier 셀렉터를 사용하지 마세요)
- 다중 modifier가 가능합니다. 각 modifier는 프로퍼티를 책임집니다: `class="alert -success -rounded -large"`. 이러한 modifier를 계속 사용하는 경우 **variable**를 고려하세요 (아래 참조)
- modifier는 하나의 책임을 지기 때문에 HTML 또는 CSS의 순서는 중요하지 않습니다.

### .component--variation

```html
<div class="button--delete">
```

```css
.button--delete {
    /* Base button classes */
    …
    
    /* Variations */
    background-color: red; 
    color: white;
    text-transform: uppercase;
}
```

- variation은 클래스에 한 번에 둘 이상의 속성을 추가하고 자주 함께 사용되는 다중 modifier에 대한 shorthand로 사용됩니다
- 기본 클래스 `button`을 사용할 필요없이 단독으로 사용됩니다.
- 여기서 `@apply`를 사용하는 것은 논리적인 경우입니다. 그래서 variation은 원래 modifier를 상속받을 수 있습니다 (**고민 중입니다**).
- 가능한 경우 variation은 일반적이고 재사용 가능해야합니다. `class="team--large"`는 `class="team--management"`보다 낫습니다.

### .helper-property

```html
<div class="align-right">
<div class="visibility-hidden">
<div class="text-ellipsis">
<div class="margin-top-s">
```

- 전체 프로젝트에서 재사용 가능한 유틸리티 클래스
- 유형별 접두사 (= 적용 할 속성)
- 각 헬퍼 클래스는 잘 정의 된 속성의 집합을 담당합니다. 이들은 컴포넌트가 아니라는 것을 분명히 해야합니다.

### .js-hook

```html
<div class="js-map …"
     data-map-icon="url.png"
     data-map-lat="4.56"
     data-map-lon="1.23">
```

-`js-hook`을 사용하여 `document.getElementsByClassName('js-hook')`와 같은 핸들러를 시작하십시오.
- 데이터 저장 또는 설정의 저장에만 `data-attributes` 사용하십시오.
- 스타일링에 아무런 영향을주지 않습니다.

## DOM structure 

- 모든 스타일은 클래스로 처리합니다. (우리가 제어 할 수없는 HTML 제외).
- 스타일에 대해 #id 를 사용하지 않습니다.
- 엘리멘츠를 프로젝트에서 쉽게 재사용하거나 움직일 수 있도록 만듭니다.
- 1 개의 DOM 요소에 여러 컴포넌트를 사용하지 마십시오. 그것들을 분할하세요.

```html
<!-- Try to avoid, news padding or margin could break the grid--> 
<div class="grid__col -1/2 news">
    …
</div>    

<!-- More flexible, readable & moveable -->
<div class="grid__col -1/2">
    <article class="news">
        …
    </article>
</div>   
```

스타일은 클래스별로 이루어지기 때문에 태그는 서로 바꿔서 사용할 수 있습니다.

```html
<!-- All the same -->
<div class="article">
<section class="article">
<article class="article">
```

제어 할 수없는 HTML 태그 (예 : editor 출력)는 컴포넌트에 의해 범위가 지정됩니다.

```html
<div class="article">
    <!-- custom html output -->
</div>    
```

```css
.article {
    /* Tag instead of class here */
    & h2 {
        …
    }

    & p {
        …
    }    
}
```

### Class order

```html
<div class="js-hook component__element -modifier helper">
```

비주얼 클래스 그룹화는 `… | …`로 처리합니다:

```html
<div class="js-masonry | news__item -blue -small -active | padding-top-s align-right">
```

## Code style

우리는 스타일시트를 lint하기 위해 [stylelint](https://github.com/stylelint/stylelint)를 사용합니다.
설정은 `stylelint-config-standard`을 확장한 커스텀`.stylelintrc`로 되어있습니다.

```
{
  "extends": "stylelint-config-standard",
  "ignoreFiles": "resources/assets/css/vendor/*",
  "rules": {
      "indentation": [4],
      "at-rule-empty-line-before": null,
      "number-leading-zero": null,
      "selector-pseudo-element-colon-notation": "single",
    }
}
```

### Installation

```
yarn add stylelint
yarn add stylelint-config-standard
```

### Usage

대부분의 프로젝트에는 `package.json`에서 사용할 수있는 린트 스크립트 (`--fix` 플래그 포함)가 있습니다.

```
stylelint resources/assets/css/**/**.css --fix -r
```

### Examples
 
```css
/* Comment */

.component {                      /* Indent 4 spaces, space before bracket */                                   
    @at-rule …;                   /*  @at-rules first */
         
    a-property: value;            /* Props sorted automatically by eg. PostCSS-sorting */
    b-property: value; 
    c-property: .45em;            /* No leading zero's */
    
    &:hover {                     /* Pseudo class */
        …
    }
    
    &:before,                     /* Pseudo-elements */
    &:after {                     /* Each on a line */
        …
    }
    
    &.-modifier {
        …                           
    }
     
    &.-modifier2 {
        …                        
    }
    
    /* Try to avoid */
    
    @apply …;                     /* Use only for variations */
    
    &_subclass {                  /* Unreadable and not searchable */
        …
    }
                
    h1 {                          /* Avoid unless you have no control over the HTML inside the `.component` */
        …
    }
          
}
                                  /* Line between classes */
.component--variation {           /* A component with few extra modifications often used together */
    @apply .component;            /* Only good use for @apply */
    …
}
    
.component__element {             /* Separate class for readability, searchability instead of `&__element`*/
    …
}

```

## File structure

일반적으로 5 개의 폴더와 메인 `app.css` 파일을 사용합니다.

```
|-- base       : basic html elements
|-- components : single components
|-- helpers    : helper classes
|-- settings   : variables
|-- vendor     : custom files from 3rd party components like fancybox, select2 etc.
`-- app.css    : main file
```


### app.css

- glob import에 `postcss-easy-import`를 사용합니다
- 폴더 순서 만 제외하고 소스 순서는 중요하지 않습니다: import npm libraries, settings or utilities first
- 파일을 쉽게 추가 할 수 있도록 glob 패턴으로 import합니다.
 
```css
@import 'settings/**/*';
@import 'base/**/*';
@import 'components/**/*';
@import 'helpers/**/*';
@import 'vendor/**/*';
```

### Base folder

기본 html 요소에 대한 재설정 및 적절한 기본값을 포함

```
|-- universal.css
|-- html.css
|-- a.css
|-- p.css
|-- heading.css (h1, h2, h3)
|-- list.css (ul, ol, dl)
`-- …
```

### Components folder

modifiers and variations가 포함된 재사용 가능한 독립 컴포넌트.

```
|-- alert.css
|-- avatar.css
`-- …
```

### Helpers folder

작은 레이아웃 문제를 위한 독립되어 있는 헬퍼 클래스.

```
|-- align.css
|-- margin.css
|-- padding.css
`-- …
```

### Settings folder

색상, breakpoints, typography 등에 대한 설정. 변수가 커지면 하나의`settings.css`로 시작하여 다른 파일로 나눌 수 있습니다.

```
|-- breakpoint.css
|-- color.css
|-- grid.css
`-- …
```

### Vendor folder

서드파티 컴포넌트에서 가져온 커스텀 CSS (이것은 와일드 웨스트(Wild West)의 문법입니다. 아마도 이것을 보완하고 싶지 않을 것입니다.)
`역자주: 외부에서 가져온, 자기들 마음대로 작성된 css기 때문에 모아두고 손대고 싶지 않은 파일로 보입니다`

```
|-- pikaday.css
|-- select2.css
`-- …
```

## Inspiration

- [CSS Wizardry](https://csswizardry.com) 
- [Chainable BEM modifiers](https://webuild.envato.com/blog/chainable-bem-modifiers/) 
