package main.java.com.plantguard.services;

import main.java.com.plantguard.models.User;
import main.java.com.plantguard.security.EncryptionUtil;

import java.security.NoSuchAlgorithmException;
import java.util.ArrayList;
import java.util.List;

public class UserService {
    
    // Lista que almacena usuarios (en una base de datos real, esta lista sería reemplazada por una base de datos)
    private List<User> users = new ArrayList<>();
    
    // Método para agregar un nuevo usuario
    public void addUser(String username, String password) throws NoSuchAlgorithmException {
        // Encriptamos la contraseña antes de almacenarla
        String encryptedPassword = EncryptionUtil.hashSHA256(password);
        
        // Creamos un nuevo usuario y lo añadimos a la lista
        User newUser = new User(username, encryptedPassword);
        users.add(newUser);
        System.out.println("Usuario " + username + " añadido con éxito.");
    }
    
    // Método para autenticar a un usuario
    public boolean authenticate(String username, String password) throws NoSuchAlgorithmException {
        // Encriptamos la contraseña proporcionada para compararla con la almacenada
        String encryptedPassword = EncryptionUtil.hashSHA256(password);
        
        for (User user : users) {
            if (user.getUsername().equals(username) && user.getHashedPassword().equals(encryptedPassword)) {
                System.out.println("Autenticación exitosa para el usuario " + username);
                return true; // Autenticación exitosa
            }
        }
        
        System.out.println("Autenticación fallida para el usuario " + username);
        return false; // Autenticación fallida
    }
    
    // Método para listar todos los usuarios (para fines de prueba)
    public void listUsers() {
        if (users.isEmpty()) {
            System.out.println("No hay usuarios registrados.");
        } else {
            System.out.println("Lista de usuarios:");
            for (User user : users) {
                System.out.println("Usuario: " + user.getUsername());
            }
        }
    }
    
    // Método para eliminar un usuario (solo por nombre)
    public boolean removeUser(String username) {
        User userToRemove = null;
        
        // Buscar el usuario por nombre
        for (User user : users) {
            if (user.getUsername().equals(username)) {
                userToRemove = user;
                break;
            }
        }
        
        // Si el usuario existe, lo eliminamos
        if (userToRemove != null) {
            users.remove(userToRemove);
            System.out.println("Usuario " + username + " eliminado.");
            return true;
        } else {
            System.out.println("El usuario " + username + " no existe.");
            return false;
        }
    }
}
