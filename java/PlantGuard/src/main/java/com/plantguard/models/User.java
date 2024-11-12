// User.java - Representa un usuario autorizado
package main.java.com.plantguard.models;

public class User {
    private String username;
    private String hashedPassword;

    // Constructor
    public User(String username, String hashedPassword) {
        this.username = username;
        this.hashedPassword = hashedPassword;
        System.out.println("DEBUG: Creada instancia de User - " + username);
    }

    // Getters y Setters
    public String getUsername() { return username; }
    public void setUsername(String username) { this.username = username; }

    public String getHashedPassword() { return hashedPassword; }
    public void setHashedPassword(String hashedPassword) { this.hashedPassword = hashedPassword; }

    // Método para mostrar información del usuario
    @Override
    public String toString() {
        return "User [Username=" + username + "]";
    }
}
