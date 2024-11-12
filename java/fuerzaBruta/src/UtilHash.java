import java.security.MessageDigest;
import java.security.NoSuchAlgorithmException;

public class UtilHash {

    /**
     * Generates an MD5 hash for the given input string.
     * 
     * @param input The string to hash.
     * @return A string representing the MD5 hash in hexadecimal format.
     */
    public static String md5Hash(String input) {
        return generateHash(input, "MD5");
    }

    /**
     * Generates a SHA-1 hash for the given input string.
     * 
     * @param input The string to hash.
     * @return A string representing the SHA-1 hash in hexadecimal format.
     */
    public static String sha1Hash(String input) {
        return generateHash(input, "SHA-1");
    }

    /**
     * A private method to generate a hash for a specified algorithm.
     * 
     * @param input     The string to hash.
     * @param algorithm The hashing algorithm to use ("MD5" or "SHA-1").
     * @return A string representing the hash in hexadecimal format.
     */
    private static String generateHash(String input, String algorithm) {
        try {
            MessageDigest md = MessageDigest.getInstance(algorithm);
            byte[] messageDigest = md.digest(input.getBytes());
            StringBuilder sb = new StringBuilder();
            for (byte b : messageDigest) {
                sb.append(String.format("%02x", b));
            }
            return sb.toString();
        } catch (NoSuchAlgorithmException e) {
            throw new RuntimeException("Hashing algorithm not supported: " + algorithm, e);
        }
    }
}
