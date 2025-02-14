-- Create the database schema
CREATE DATABASE emensawerbeseite
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

USE emensawerbeseite;

-- Create the `gericht` table
CREATE TABLE gericht (
    id BIGINT AUTO_INCREMENT PRIMARY KEY COMMENT 'Primärschlüssel',
    name VARCHAR(80) NOT NULL COMMENT 'Name des Gerichts. Ein Name ist eindeutig.',
    beschreibung VARCHAR(800) NOT NULL COMMENT 'Beschreibung des Gerichts.',
    erfasst_am DATE NOT NULL COMMENT 'Zeitpunkt der Erfassung des Gerichts.',
    vegetarisch BOOLEAN NOT NULL COMMENT 'Markierung, ob das Gericht vegetarisch ist. Standard: Nein.',
    vegan BOOLEAN NOT NULL COMMENT 'Markierung, ob das Gericht vegan ist. Standard: Nein.',
    preisintern DOUBLE NOT NULL COMMENT 'Preis für interne Person (wie Studierende). Es gilt immer preisintern > 0.',
    preisextern DOUBLE NOT NULL COMMENT 'Preis für externe Personen (wie Gastdozent:innen).',
    bild_url VARCHAR(255) COMMENT 'URL für das Bild des Gerichts.'
);

-- Create the `allergen` table
CREATE TABLE allergen (
    code CHAR(4) PRIMARY KEY COMMENT 'Offizieller Abkürzungsbuchstabe für das Allergen.',
    name VARCHAR(300) NOT NULL COMMENT 'Name des Allergens, wie "Glutenhaltiges Getreid".',
    typ VARCHAR(200) NOT NULL COMMENT 'Gibt den Typ an. Standard: "Allergen".'
);

-- Create the `kategorie` table
CREATE TABLE kategorie (
    id BIGINT PRIMARY KEY COMMENT 'Primärschlüssel',
    name VARCHAR(80) NOT NULL COMMENT 'Name der Kategorie, z.B "Hauptgericht", "Vorspeise", "Salat", "Sauce" oder "Käsegericht".',
    eltern_id BIGINT COMMENT 'Referenz auf eine (Eltern-)Kategorie. Es soll eine Baumstruktur innerhalb der Kategorien abgebildet werden. Zum Beispiel enthält die Kategorie „Hauptgericht“ alle Kategorien, denen Gerichte zugeordnet sind, die als Hauptgang vorgesehen sind.',
    bildname VARCHAR(20) COMMENT 'Name der Bilddatei, die eine Darstellung der Kategorie enthält.'
);

-- Create the `gericht_hat_allergen` table
CREATE TABLE gericht_hat_allergen (
    code CHAR(4) COMMENT 'Referenz auf Allergen.',
    gericht_id BIGINT COMMENT 'Referenz auf das Gericht.',
    PRIMARY KEY (code, gericht_id), -- Composite primary key
    FOREIGN KEY (code) REFERENCES allergen(code) ON DELETE CASCADE, -- Foreign key to allergen
    FOREIGN KEY (gericht_id) REFERENCES gericht(id) ON DELETE CASCADE -- Foreign key to gericht
);

-- Create the `gericht_hat_kategorie` table
CREATE TABLE gericht_hat_kategorie (
    gericht_id BIGINT NOT NULL COMMENT 'Referenz auf das Gericht.',
    kategorie_id BIGINT NOT NULL COMMENT 'Referenz auf die Kategorie.',
    PRIMARY KEY (gericht_id, kategorie_id), -- Composite primary key
    FOREIGN KEY (gericht_id) REFERENCES gericht(id) ON DELETE CASCADE, -- Foreign key to gericht
    FOREIGN KEY (kategorie_id) REFERENCES kategorie(id) ON DELETE CASCADE -- Foreign key to kategorie
);