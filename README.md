
사이트맵 Lite
============

XE로 만든 사이트의 메뉴 구조를 바탕으로 사이트맵(sitemap.xml)을 만들어 주는 모듈입니다.

기존의 사이트맵 모듈과 달리, 개별 문서가 아닌 메뉴 위주로 사이트맵을 생성하므로
사이트맵의 용량이 작고 분할할 필요가 없어 여러 검색엔진과의 호환성이 높습니다.

주요 기능
---------

- 사이트맵에 포함할 메뉴를 1개~다수 선택 가능
- 메뉴에 포함되지 않은 주소도 임의로 추가 가능
- 사이트맵에 포함할 수 없는 외부 주소는 자동으로 제외됨
- XE를 서브디렉토리에 설치한 경우에도 사이트 루트에 sitemap.xml 파일을 생성할 수 있음
- 메뉴 구조 변경시 사이트맵 자동 갱신
- 사이트맵을 갱신할 때마다 Google, Bing 검색엔진에 자동 제출

주의사항
--------

- 메뉴에서 링크하거나 추가로 등록하지 않은 개별 문서는 사이트맵에 포함되지 않습니다. (최신글이 자동으로 등록되지 않습니다.)
- sitemap.xml 파일을 웹서버가 생성하거나 쓸 수 있도록 퍼미션을 조정해 주어야 합니다.
  - sitemap.xml 파일을 직접 생성한 후 퍼미션을 666으로 변경하거나
  - sitemap.xml 파일을 생성할 폴더의 퍼미션을 777로 변경하거나
- 일부 검색엔진은 사이트맵을 직접 제출하거나 robots.txt에 링크를 추가해 주어야 합니다.

라이선스
--------

이 모듈은 GPLv2 라이선스의 적용을 받습니다.
