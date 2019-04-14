@component('layouts.app')
    <section class="home">
        <header class="home__header waves">
            <div class="home__header__inner">
                <div class="home__logo">
                    <a href="https://spatie.be" target="spatie">
                        @include('svg.logo')
                    </a>
                </div>
                <h1 class="home__title">
                    Guidelines - 한국어
                </h1>
            </div>
        </header>
        <section class="home__introduction">
            <p style="color:red;">
                이 서버는 개인이 spatie의 가이드라인을 번역한 것으로 공식문서가 아닙니다.
                정확한 문서는 <a href="https://guidelines.spatie.be/" target="_blank">여기</a>에서 확인가능합니다
            </p>
            <p class="-large">
                이 사이트에는 프로젝트를 성공적으로 수행하기 위해 사용하는 일련의 지침이 포함되어 있습니다. 일관성은 유지 보수가 가능한 소프트웨어의 가장 중요한 특징 중 하나이기 때문에 우리는 워크 플로를 문서화하기로 결정했습니다.
            </p>
            <p>
                이 사이트의 내용은 우리 자신을 위해 존재합니다. 더 중요한 것은 미래의 자아입니다. 미래의 동료들에게 사물과 단점을 수행하는 방식에 대한 참고서를 제공하기 위해서입니다. 이 가이드라인은 워크 플로, 코드 스타일 및 문서화 할 가치가 있다고 생각되는 기타 작은 것들을 다룹니다.
            </p>
            <p>
                모든 페이지는 <a href="https://github.com/spatie/guidelines.spatie.be" target="spatie"> GitHub </a>에서 제공되며 편집 및 개선을 환영합니다. 참고로 이것들은 우리가 생각한 아이디어이기 때문에 중요한 변화가 있을 때는 우리는 예민하게 굴 수 있습니다.
            </p>
        </section>
        <nav class="home__index">
            <div class="home__index__inner">
                {{ app('navigation')->menu()->addClass('menu--home') }}
            </div>
            <footer class="home__index__footer">
                <a href="https://spatie.be" target="spatie">
                    © spatie.be, Antwerp
                </a>
            </footer>
        </nav>
    </section>
@endcomponent
