// PlantService.java - Servicios CRUD para plantas
package main.java.com.plantguard.services;

import main.java.com.plantguard.models.Plant;
import java.util.ArrayList;
import java.util.List;

public class PlantService {
    private List<Plant> plants;

    // Constructor inicializa la lista de plantas
    public PlantService() {
        this.plants = new ArrayList<>();
        System.out.println("DEBUG: PlantService inicializado.");
    }

    // Añade una planta a la lista
    public void addPlant(Plant plant) {
        plants.add(plant);
        System.out.println("DEBUG: Planta añadida - " + plant.getScientificName());
    }

    // Obtiene una planta por su ID
    public Plant getPlantById(String id) {
        for (Plant plant : plants) {
            if (plant.getId().equals(id)) {
                System.out.println("DEBUG: Planta encontrada - " + plant.getScientificName());
                return plant;
            }
        }
        System.out.println("DEBUG: Planta no encontrada - ID: " + id);
        return null;
    }

    // Lista todas las plantas
    public List<Plant> listPlants() {
        System.out.println("DEBUG: Listando todas las plantas.");
        return new ArrayList<>(plants);
    }
}
