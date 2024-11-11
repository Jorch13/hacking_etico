import java.io.*;

public class FuerzaBruta {

    public static void main(String[] args) {
        // El hash objetivo (puedes probar con un hash MD5 o SHA1)
        String targetHash = "5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8"; // Hash de "password"

        // Leer la lista de contraseñas comunes desde un archivo
        File passwordFile = new File("G:/CETI/Hacking etico/Proyectos_personales/hacking_etico/java/fuerzaBruta/listaClaves.txt");
        BufferedReader reader;

        try {
            // Verifica si el archivo existe
            if (!passwordFile.exists()) {
                System.out.println("Error: El archivo no se encuentra en la ruta especificada.");
                return;
            }

            reader = new BufferedReader(new FileReader(passwordFile));
            String password;

            while ((password = reader.readLine()) != null) {
                String hash = UtilHash.md5Hash(password);  // Puedes cambiar a SHA1 si lo deseas

                // Verificar si el hash generado coincide con el hash objetivo
                if (hash.equals(targetHash)) {
                    System.out.println("Contraseña encontrada: " + password);
                    break;
                }
            }

            reader.close();
        } catch (FileNotFoundException e) {
            System.out.println("Error: No se pudo encontrar el archivo de contraseñas.");
            e.printStackTrace();
        } catch (IOException e) {
            System.out.println("Error al leer el archivo de contraseñas.");
            e.printStackTrace();
        }
    }
}
