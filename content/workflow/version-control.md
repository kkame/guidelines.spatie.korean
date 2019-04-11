# Version Control

모든 프로젝트는 Git을 사용합니다. 대부분 GitHub에서 호스팅되는 저장소가 있습니다. 우리는 소규모 팀이기 때문에 대부분의 프로젝트에는 3 명 이하의 사람들이 동시에 작업하고 있습니다. 갈등이 거의 발생하지 않기 때문에 Git 지침이 상당히 느슨합니다.

## Repo naming conventions

repo에 사이트의 소스 코드가 포함되어있는 경우 해당 이름은 해당 사이트의 기본 쌩자(naked) 도메인 이름이어야합니다. 소문자이어야합니다.

- Bad: `https://www.spatie.be`, `www.spatie.be`, `Spatie.be`
- Good: `spatie.be`

서브 도메인에서 호스팅되는 사이트는 해당 서브 도메인의 이름을 사용할 수 있습니다.

- Bad: `spatie.be-guidelines`
- Good: `guidelines.spatie.be`

repo가 ​​다른 것, 예를 들어 패키지와 관련되어있는 경우, 그 이름은 케밥 케이스 (kebab-cased) 여야합니다.

- Bad: `LaravelBackup`, `Spoon`
- Good: `laravel-backup`, `spoon`

## Branches

이 가이드에서 한 가지를 기억하려면 다음을 기억하십시오. **프로젝트가 시작되면 마스터 브랜치는 항상 안정적이어야합니다**. 항상 마스터 브랜치를 프로덕션 환경에 배포하는 것이 안전해야합니다. 모든 브랜치는 활성화 되어있다고 가정합니다. 관리되지 않는 브랜치는 정리해야합니다.

### 초기 개발 프로젝트

아직 라이브되지 않은 프로젝트에는 최소한 두 개의 브랜치가 있습니다 : `master` 와 `develop`. master 브랜치에서 직접 커밋하지 말고 항상 develop 브랜치에 커밋하십시오.

feature 브랜치는 선택 사항입니다. feature 브랜치를 만들고 싶다면 `master`가 아닌 `develop`에서 분기해야합니다.

### Live projects

프로젝트가 실행되면 `develop` 브랜치가 삭제됩니다. `master`에 대한 모든 커밋은 feature 브랜치를 통해 추가되어야합니다. 대부분의 경우 병합시 커밋을 스쿼시(squash)하는 것이 좋습니다.

feature 브랜치 이름에 대한 엄격한 규칙은 없으며, 자신이 원하는 것을 알기에 충분히 명확하게 생성합니다. 브랜치에는 소문자와 하이픈 만 사용할 수 있습니다.

- Bad: `feature/mailchimp`, `random-things`, `develop`
- Good: `feature-mailchimp`, `fix-deliverycosts` or `updates-june-2016`

### Pull requests

GitHub Pull request를 통해 브랜치를 병합하는 것은 필수 사항은 아니지만 다음과 같은 경우에 유용 할 수 있습니다.

- 동료가 변경 사항을 검토하길 원합니다.
- 브랜치를 병합하고 인터페이스를 통해 커밋 할 수 있음을 보장하고자합니다.
- 전달 된 Pull request을 탐색하여 기록에서 해당 시점을 빠르게 검색 할 수있기를 원합니다.

### Merging and rebasing

이상적으로, 브랜치를 정기적으로 리베이스하여 병합 충돌을 줄이십시오.

- master에 feature 브랜치를 배치하려면, `git merge <branch> --squash`
- 푸시가 거부되면, `git rebase`를 사용하여 먼저 브랜치를 리베이스하십시오.

## Commits

초기 개발 프로젝트에서 커밋에 대한 엄격한 규칙은 없지만 서술적인(descriptive) 커밋 메시지를 사용하는 것이 좋습니다. 프로젝트가 라이브 된 후에는 서술적인 커밋 메시지가 필요합니다. 커밋 메시지에는 항상 현재 시제를 사용하십시오.

- 비서술적인(Non-descriptive): `wip`, `commit`, `a lot`, `solid`
- 서술적인(Descriptive): `Update deps`, `Fix vat calculation in delivery costs`

이상적으로는 세분화 된 커밋을 선호합니다.

- Acceptable: `Cart fixes`
- Better: `Fix add to cart button`, `Fix cart count on home`

## Git Tips

### `patch`로 세분화 된 커밋 만들기

만약 여러번 변경했지만 더 세분화 된 커밋으로 나누고 싶다면 `git add -p`를 사용하십시오. 그러면 커밋을 위해 준비 할 청크를 선택할 수있는 대화식 세션이 열립니다.

### 새 브랜치로 커밋 이동

먼저 새 브랜치를 만든 다음 현재 브랜치를 되돌리고 마지막으로 브랜치를 체크 아웃합니다.

공동 작업자와 이중으로 확인하지 않고 이미 푸시 된 커밋에 이 작업을 수행하지 마십시오!

```bash
git branch my-branch
git reset --hard HEAD~3 # OR git reset --hard <commit>
git checkout my-branch
```

### 스쿼시 커밋이 이미 푸시 됨

커밋 중에 아무도 변경 사항을 푸시하지 않았을 때만 실행하십시오.

먼저 이전에 커밋 된 SHA를 커밋해야 할 커밋으로 복사하십시오.

```bash
git reset --soft <commit>
git commit -m "your new message"
git push --force
```

### 로컬 브랜치 정리

잠시 후, 당신은 당신의 로컬 저장소에 몇 개의 관리되지 않는 브랜치를 끝낼 것입니다. 업스트림에 존재하지 않는 브랜치는 `git remote prune origin` 으로 정리할 수 있습니다. 중요한 것을 지우지 않으려면`--dry-run` 플래그를 추가하십시오.

## Resources

- 대부분이 [GitHub Flow](https://guides.github.com/introduction/flow/)를 기반으로합니다.
- Merge vs. rebase [Atlassian](https://www.atlassian.com/git/tutorials/merging-vs-rebasing/workflow-walkthrough)
- Merge vs. rebase [@porteneuve](https://medium.com/@porteneuve/getting-solid-at-git-rebase-vs-merge-4fa1a48c53aa)