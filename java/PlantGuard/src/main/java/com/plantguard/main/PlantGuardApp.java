// PlantGuardApp.java - Clase principal de la aplicación
package main.java.com.plantguard.main;

import main.java.com.plantguard.models.Plant;
import main.java.com.plantguard.services.PlantService;
import main.java.com.plantguard.security.Authentication;

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

        // Autenticación de prueba
        Authentication auth = new Authentication();
        auth.authenticate("admin", "5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8"); // Intento de autenticación

        // Listar todas las plantas
        for (Plant plant : plantService.listPlants()) {
            System.out.println(plant);
        }

        System.out.println("PlantGuard: Finalizando aplicación.");
    }
}
