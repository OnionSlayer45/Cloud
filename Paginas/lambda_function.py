"""
AWS Lambda (Python 3.12): recomienda juegos de mesa según jugadores y tiempo.

Uso (Function URL o API Gateway HTTP API):
    GET ?jugadores=4&minutos=60
    GET ?jugadores=4&minutos=60&genero=Cartas&limite=1

Variables de entorno:
    DB_HOST, DB_USER, DB_PASSWORD, DB_NAME   (obligatorias)
    DB_PORT         (opcional, por defecto 3306)
    ALLOWED_ORIGIN  (opcional, por defecto *)

Regla: el campo "jugadores" de la tabla se toma como la capacidad del juego,
así que se recomiendan juegos con jugadores >= los pedidos y duracion <= minutos.
"""
import json
import os

import pymysql
from pymysql.cursors import DictCursor

conexion = None  # se reutiliza entre invocaciones


def obtener_conexion():
    global conexion
    if conexion is None:
        conexion = pymysql.connect(
            host=os.environ["DB_HOST"],
            user=os.environ["DB_USER"],
            password=os.environ["DB_PASSWORD"],
            database=os.environ["DB_NAME"],
            port=int(os.environ.get("DB_PORT", "3306")),
            charset="utf8mb4",
            cursorclass=DictCursor,
            connect_timeout=5,
            autocommit=True,
        )
    else:
        conexion.ping(reconnect=True)
    return conexion


def respuesta(codigo, cuerpo):
    return {
        "statusCode": codigo,
        "headers": {
            "Content-Type": "application/json; charset=utf-8",
            "Access-Control-Allow-Origin": os.environ.get("ALLOWED_ORIGIN", "*"),
        },
        "body": json.dumps(cuerpo, ensure_ascii=False),
    }


def lambda_handler(event, context):
    params = event.get("queryStringParameters") or {}

    try:
        jugadores = int(params["jugadores"])
        minutos = int(params["minutos"])
        limite = min(max(int(params.get("limite", 5)), 1), 20)
    except (KeyError, ValueError):
        return respuesta(400, {"error": "Indica jugadores y minutos como números enteros"})

    if jugadores < 1 or minutos < 1:
        return respuesta(400, {"error": "jugadores y minutos deben ser mayores que 0"})

    genero = (params.get("genero") or "").strip()

    sql = "SELECT nombre, genero, jugadores, duracion FROM juegos WHERE jugadores >= %s AND duracion <= %s"
    valores = [jugadores, minutos]
    if genero:
        sql += " AND genero = %s"
        valores.append(genero)
    sql += " ORDER BY RAND() LIMIT %s"
    valores.append(limite)

    try:
        with obtener_conexion().cursor() as cursor:
            cursor.execute(sql, valores)
            juegos = cursor.fetchall()
    except pymysql.MySQLError as error:
        print("Error de base de datos:", error)  # queda en CloudWatch
        return respuesta(500, {"error": "No se pudo consultar la base de datos"})

    return respuesta(200, {"total": len(juegos), "juegos": juegos})
