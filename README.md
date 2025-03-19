# Тестовое задание

## API
### Передача значения
```
GET /api?sensor={sensorId}
```
sensorId - id сенсора (обязательный)

Значение передается в теле запроса в виде строки {key}={value}
key - идентификатор измеряемой величины (обязательный)
value - измеряемое значение (обязательный)
### Получения значений
```
POST /api?sensor={sensorId}&key={key}&from={from}&to={to}
```
sensorId - id сенсора (обязательный)
key - идентификатор измеряемой величины (обязательный)
from - начальная дата в формате Y-m-d H:i:s
to - конечная дата в формате Y-m-d H:i:s

## Как развернуть
Приложение разворачивается в контейнерах Docker.
Нужно выполнить команды:
```
cd .docker
docker compose up -d
docker exec -it konkord_php bash
cd laravel
php artisan migrate
```


