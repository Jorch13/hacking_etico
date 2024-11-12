package main.java.com.plantguard.main;

import main.java.com.plantguard.models.Plant;
import main.java.com.plantguard.services.PlantService;
import main.java.com.plantguard.services.UserService; // Importar la clase UserService
import main.java.com.plantguard.audit.AuditLog; // Importar la clase AuditLog
import java.security.NoSuchAlgorithmException;

public class PlantGuardApp {
    public static void main(String[] args) {
        System.out.println("\n=== PlantGuard: Iniciando aplicación ===\n");

        // Log de auditoría - Inicio de la aplicación
        AuditLog.logEvent("Aplicación iniciada.");

        // Inicialización del servicio de plantas
        PlantService plantService = new PlantService();

        // Creación de plantas de prueba
        Plant plant1 = new Plant("1", "Quercus robur", "Oak", "Forest");
        Plant plant2 = new Plant("2", "Pinus sylvestris", "Scots Pine", "Mountains");

        // Añadir plantas al servicio
        plantService.addPlant(plant1);
        plantService.addPlant(plant2);

        // Log de auditoría - Registro de evento al añadir plantas
        AuditLog.logEvent("Planta añadida: " + plant1.getScientificName());
        AuditLog.logEvent("Planta añadida: " + plant2.getScientificName());

        // Inicializar UserService para gestionar usuarios
        UserService userService = new UserService();

        try {
            // Agregar un usuario de prueba
            userService.addUser("admin", "password");

            // Intentar autenticar al usuario
            boolean isAuthenticated = userService.authenticate("admin", "password"); // Intento de autenticación

            if (isAuthenticated) {
                System.out.println("\n*** Usuario autenticado exitosamente ***\n");
                // Log de auditoría - Registro de evento de autenticación
                AuditLog.logEvent("Usuario autenticado: admin");
            } else {
                System.out.println("\n*** Autenticación fallida ***\n");
                // Log de auditoría - Registro de fallo en autenticación
                AuditLog.logEvent("Fallo en autenticación: admin");
            }
        } catch (NoSuchAlgorithmException e) {
            System.out.println("\n!!! Error en la encriptación de la contraseña: " + e.getMessage() + " !!!\n");
        }

        // Listar todas las plantas
        for (Plant plant : plantService.listPlants()) {
            System.out.println(plant);
        }

        System.out.println("\n=== PlantGuard: Finalizando aplicación ===\n");

        // Log de auditoría - Finalización de la aplicación
        AuditLog.logEvent("Aplicación finalizada.");
    }
}
