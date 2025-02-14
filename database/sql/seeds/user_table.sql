CREATE TABLE benutzer (
    id BIGINT AUTO_INCREMENT PRIMARY KEY, -- Eindeutige ID, Auto-Inkrement
    name VARCHAR(200) NOT NULL,          -- Name, der auch auf der Oberfläche dargestellt wird
    email VARCHAR(100) NOT NULL UNIQUE,  -- Eindeutige E-Mail-Adresse, Teil der Anmeldung
    passwort VARCHAR(200) NOT NULL,      -- Speicherung des Passwort-Hashs (SHA-1)
    admin BOOLEAN NOT NULL DEFAULT FALSE, -- Markierung, ob Admin. Standard: false
    anzahlfehler INT NOT NULL DEFAULT 0, -- Zähler für fehlgeschlagene Anmeldungen
    anzahlanmeldungen INT NOT NULL DEFAULT 0, -- Zähler für erfolgreiche Anmeldungen
    letzteanmeldung DATETIME DEFAULT NULL,  -- Zeitpunkt der letzten erfolgreichen Anmeldung
    letzterfehler DATETIME DEFAULT NULL     -- Zeitpunkt des letzten Fehlversuchs
);
