import java.io.*;
import java.security.MessageDigest;
import java.security.NoSuchAlgorithmException;

public class FuerzaBruta {

    public static void main(String[] args) {
        // Target hash to be matched (either MD5 or SHA-1)
        String targetHash = "5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8"; // SHA-1 hash for "password"

        // Attempt to load the password list file from the classpath
        InputStream inputStream = FuerzaBruta.class.getResourceAsStream("/listaClaves.txt");
        if (inputStream == null) {
            System.out.println("Error: Could not find listaClaves.txt in the classpath.");
            return;
        } else {
            System.out.println("File listaClaves.txt found in the classpath.");
        }

        try (BufferedReader reader = new BufferedReader(new InputStreamReader(inputStream))) {
            String password;
            boolean found = false;

            System.out.println("Starting brute-force search for the matching hash...\n");

            // Loop through each password in the file
            while ((password = reader.readLine()) != null) {
                // Generate MD5 and SHA-1 hashes for each password
                String md5Hash = UtilHash.md5Hash(password);
                String sha1Hash = UtilHash.sha1Hash(password);

                // Print formatted hash information for debugging
                System.out.printf("Password: %-12s | MD5: %-32s | SHA-1: %-40s%n", password, md5Hash, sha1Hash);

                // Check if either hash matches the target hash
                if (md5Hash.equals(targetHash)) {
                    System.out.println("\nMatch found using MD5! Password: " + password);
                    found = true;
                    break;
                } else if (sha1Hash.equals(targetHash)) {
                    System.out.println("\nMatch found using SHA-1! Password: " + password);
                    found = true;
                    break;
                }
            }

            // If no match was found
            if (!found) {
                System.out.println("\nNo match found for the target hash.");
            }

        } catch (IOException e) {
            System.out.println("Error reading the password file.");
            e.printStackTrace();
        }
    }
}
