import java.io.*;

public class FuerzaBruta {

    public static void main(String[] args) {
        // El hash objetivo (puedes probar con un hash MD5 o SHA1)
        String targetHash = "5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8"; // Hash de "password"

        // Cargar la lista de contraseñas comunes desde el archivo en la carpeta src
        InputStream inputStream = FuerzaBruta.class.getResourceAsStream("/listaClaves.txt");
        if (inputStream == null) {
            System.out.println("Error: No se encontró el archivo listaClaves.txt en el classpath.");
            return;
        }

        try (BufferedReader reader = new BufferedReader(new InputStreamReader(inputStream))) {
            String password;

            while ((password = reader.readLine()) != null) {
                String hash = UtilHash.md5Hash(password); // Puedes cambiar a SHA1 si lo deseas

                // Verificar si el hash generado coincide con el hash objetivo
                if (hash.equals(targetHash)) {
                    System.out.println("Contraseña encontrada: " + password);
                    break;
                }
            }

        } catch (IOException e) {
            System.out.println("Error al leer el archivo de contraseñas.");
            e.printStackTrace();
        }
    }
}
