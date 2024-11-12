package main.java.com.plantguard.audit;

import java.io.File;
import java.io.FileWriter;
import java.io.IOException;
import java.time.LocalDateTime;
import java.time.format.DateTimeFormatter;

public class AuditLog {

    private static final String LOG_FILE_PATH = "audit_log.txt"; // Path to store the log file

    // Method to log events to the audit log
    public static void logEvent(String eventDescription) {
        FileWriter writer = null;
        try {
            // Prepare the log message with timestamp and event description
            String timestamp = LocalDateTime.now().format(DateTimeFormatter.ofPattern("yyyy-MM-dd HH:mm:ss"));
            String logMessage = String.format("%s - %s\n", timestamp, eventDescription);

            // Create a file object for the audit log
            File logFile = new File(LOG_FILE_PATH);

            // If the file doesn't exist, create it
            if (!logFile.exists()) {
                logFile.createNewFile();
            }

            // Write the log message to the file
            writer = new FileWriter(logFile, true); // true for append mode
            writer.write(logMessage);
            System.out.println("Event logged: " + eventDescription); // For debugging

        } catch (IOException e) {
            System.err.println("Error while writing to audit log: " + e.getMessage());
        } finally {
            // Close the writer to ensure the file is saved
            try {
                if (writer != null) {
                    writer.close();
                }
            } catch (IOException e) {
                System.err.println("Error while closing FileWriter: " + e.getMessage());
            }
        }
    }

    // Example of logging an event
    public static void main(String[] args) {
        // Log an example event
        logEvent("User admin logged in.");
    }
}
