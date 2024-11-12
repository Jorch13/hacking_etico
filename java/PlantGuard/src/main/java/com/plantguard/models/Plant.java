// Plant.java - Representa una especie de planta
package main.java.com.plantguard.models;

public class Plant {
    private String id;
    private String scientificName;
    private String commonName;
    private String habitat;

    // Constructor
    public Plant(String id, String scientificName, String commonName, String habitat) {
        this.id = id;
        this.scientificName = scientificName;
        this.commonName = commonName;
        this.habitat = habitat;
        System.out.println("DEBUG: Creada instancia de Plant - " + scientificName);
    }

    // Getters y Setters
    public String getId() { return id; }
    public void setId(String id) { this.id = id; }
    
    public String getScientificName() { return scientificName; }
    public void setScientificName(String scientificName) { this.scientificName = scientificName; }

    public String getCommonName() { return commonName; }
    public void setCommonName(String commonName) { this.commonName = commonName; }

    public String getHabitat() { return habitat; }
    public void setHabitat(String habitat) { this.habitat = habitat; }

    // Método para mostrar información de la planta
    @Override
    public String toString() {
        return "Plant [ID=" + id + ", Scientific Name=" + scientificName + ", Common Name=" + commonName + ", Habitat=" + habitat + "]";
    }
}
