chcp 65001

@echo off
setlocal enabledelayedexpansion

REM 件数カウント
set count=0
for /r src %%f in (*.webp) do (
  set /a count+=1
)
echo 以下の!count!件のwebpファイルをすべて削除します:
for /r src %%f in (*.webp) do echo %%f

set /p ans=本当に削除してよいですか？ [Y/N]=
if /i "%ans%"=="Y" del /s /q src\\*.webp

pause