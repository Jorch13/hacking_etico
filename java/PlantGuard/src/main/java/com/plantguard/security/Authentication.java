// Authentication.java - Maneja la autenticación de usuarios
package main.java.com.plantguard.security;

import main.java.com.plantguard.models.User;
import java.util.ArrayList;
import java.util.List;

public class Authentication {
    private List<User> authorizedUsers;

    // Constructor inicializa la lista de usuarios
    public Authentication() {
        this.authorizedUsers = new ArrayList<>();
        loadAuthorizedUsers();
        System.out.println("DEBUG: Autenticación inicializada con usuarios autorizados.");
    }

    // Simula la carga de usuarios autorizados
    private void loadAuthorizedUsers() {
        authorizedUsers.add(new User("admin", "5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8")); // Hash SHA-1 de "password"
        System.out.println("DEBUG: Usuarios autorizados cargados.");
    }

    // Verifica si el usuario es válido
    public boolean authenticate(String username, String hashedPassword) {
        for (User user : authorizedUsers) {
            if (user.getUsername().equals(username) && user.getHashedPassword().equals(hashedPassword)) {
                System.out.println("DEBUG: Usuario autenticado - " + username);
                return true;
            }
        }
        System.out.println("DEBUG: Fallo de autenticación - " + username);
        return false;
    }
}
