package main.java.com.plantguard.main;

import main.java.com.plantguard.models.Plant;
import main.java.com.plantguard.services.PlantService;
import main.java.com.plantguard.security.Authentication;
import main.java.com.plantguard.audit.AuditLog; // Importa la clase AuditLog

public class PlantGuardApp {
    public static void main(String[] args) {
        System.out.println("PlantGuard: Iniciando aplicación...");

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

        // Autenticación de prueba
        Authentication auth = new Authentication();
        boolean isAuthenticated = auth.authenticate("admin", "5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8"); // Intento de
                                                                                                          // autenticación

        if (isAuthenticated) {
            System.out.println("Usuario autenticado exitosamente.");
            // Log de auditoría - Registro de evento de autenticación
            AuditLog.logEvent("Usuario autenticado: admin");
        } else {
            System.out.println("Autenticación fallida.");
            // Log de auditoría - Registro de fallo en autenticación
            AuditLog.logEvent("Fallo en autenticación: admin");
        }

        // Listar todas las plantas
        for (Plant plant : plantService.listPlants()) {
            System.out.println(plant);
        }

        System.out.println("PlantGuard: Finalizando aplicación.");

        // Log de auditoría - Finalización de la aplicación
        AuditLog.logEvent("Aplicación finalizada.");
    }
}
