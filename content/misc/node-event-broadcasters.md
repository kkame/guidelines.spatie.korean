# Node Event Broadcasters

다음은 nodejs 이벤트 브로드 캐스터를 설정하는 방법에 대한 퀵 가이드입니다. 우리는 socket.io를 사용하는 어플리케이션에서 이를 사용합니다.

노드 프로세스는 supervisord에 의해 실행됩니다. 먼저 `/etc/supervisor/conf.d/broadcaster.conf`에 새로운 수퍼바이저 프로그램을 만듭니다.

```
[program:broadcaster]
command=node /home/forge/xxxxx/broadcaster/server.js
directory=/home/forge/xxxxx
autostart=true
autorestart=true
startretries=3
stderr_logfile=/var/log/broadcaster.err.log
stdout_logfile=/var/log/broadcaster.out.log
user=forge
```

프로그램이 준비되면 다음 명령을 사용하여 실행하십시오.

```bash
supervisorctl reread
supervisorctl update
```

`sudo supervisorctl`을 실행하여 상태를 확인할 수 있습니다.

자세한 내용은 [Servers for Hackers](https://serversforhackers.com/monitoring-processes-with-supervisord)를 참조하십시오.