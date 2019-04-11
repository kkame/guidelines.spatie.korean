# New Project Setup

## Git Repository

[Blender](https://github.com/spatie/blender) 또는 [Spoon](https://github.com/spatie/spoon) 어플리케이션을 생성하려면 먼저 메인 저장소를 복제하고 `.git` 폴더를 삭제합니다. 이것은 새 프로젝트의 기본 어플리케이션이 됩니다.

[repo naming rules](https://guidelines.spatie.be/workflow/version-control#repo-naming-conventions)를 사용하여 GitHub의 Spatie 조직에 저장소를 만듭니다.

예: `spatie/guidelines.spatie.be`

마지막으로 `.env.example` 파일을 프로젝트와 관련된 값으로 수정하십시오 (데이터베이스 이름, app url, Slack webhook url 등)

## Server

1. Forge에서 새 서버를 생성하십시오. droplet에 대한 케밥 케이스 버전의 도메인 이름을 사용하십시오 (예 :`guidelines-spatie-be`) `역자주: droplet은 DigitalOcean의 가상 서버입니다`)
1. 루트로 `/current/public` 으로 새로운 사이트를 만듭니다.
1. 데이터베이스 이름의 의미를 확인하십시오.
1. 새로 프로비저닝 된 서버에서 실행 가능한 스크립트를 실행하십시오.
1. 하나 또는 두 개의 큐 작업자를 시작하십시오 :`default`, 그리고 블렌더를 사용한다면 `media_queue`
1. 관련 `.env` 변수를 업데이트하십시오. 나중에 필요한 서비스 API 키를 추가하는 것을 잊지 마십시오.
1. 프로젝트의 백업 PC에서 백업 사용
1. 우리의 공유 `.ssh/config` 파일을 업데이트하십시오. 그렇게 우리는 사용자 이름을 지정하지 않고 서버에 SSH 할 수 있습니다

## Services

Blender 사이트는 몇 가지 서드파티 서비스를 사용합니다. 다음은 설정해야 할 사항에 대한 체크리스트입니다.

별도로 명시하지 않는 한 웹 사이트의 도메인 이름을 식별자 (API 키 이름, 속성 이름 등)로 사용합니다.

1. 새로운 **Sendgrid** API 키를 만듭니다.
1. 새로운 **Google Analytics** 속성 만들기
1. 새로운 **Google Tag Manager** 컨테이너를 만듭니다.
    - Universal Analytics ID가 포함 된 상수 만들기
    - Google Analytics pageviews용 태그 설정
1. Laravel에 **Bugsnag** 설정
1. JavaScript 용 **Bugsnag** 설정