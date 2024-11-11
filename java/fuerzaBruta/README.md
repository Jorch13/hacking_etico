# Brute Force Attack en Java

Este proyecto es un ejemplo de un ataque de **fuerza bruta** utilizando Java. El objetivo de este script es demostrar cómo se puede romper un hash MD5 o SHA1 utilizando una lista de contraseñas comunes.

## Estructura del Proyecto

- **HashUtil.java**: Contiene funciones para generar hashes MD5 y SHA-1.
- **BruteForce.java**: Script principal que realiza el ataque de fuerza bruta comparando contraseñas con el hash proporcionado.
- **PasswordList.txt**: Lista de contraseñas comunes para probar contra el hash objetivo.

## Uso

1. Asegúrate de tener instalado Java en tu sistema.
2. Crea un archivo `PasswordList.txt` con una lista de contraseñas comunes que quieras probar.
3. Modifica el `targetHash` en `BruteForce.java` para usar el hash que deseas intentar romper.
4. Ejecuta el programa usando el siguiente comando:

   ```bash
   javac BruteForce.java HashUtil.java
   java BruteForce
