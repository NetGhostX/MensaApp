-- First, let's check the parent tables' structure
SHOW CREATE TABLE gericht;
SHOW CREATE TABLE benutzer;

-- Now create the meal_ratings table with matching column types
DROP TABLE IF EXISTS meal_ratings;

CREATE TABLE meal_ratings (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    gericht_id BIGINT NOT NULL,
    benutzer_id BIGINT NOT NULL,
    comment TEXT NOT NULL,
    rating ENUM('sehr gut', 'gut', 'schlecht', 'sehr schlecht') NOT NULL,
    highlighted BOOLEAN NOT NULL DEFAULT FALSE,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT meal_ratings_gericht_id_foreign 
        FOREIGN KEY (gericht_id) 
        REFERENCES gericht(id),
    CONSTRAINT meal_ratings_benutzer_id_foreign 
        FOREIGN KEY (benutzer_id) 
        REFERENCES benutzer(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Add indexes after table creation
ALTER TABLE meal_ratings
ADD CONSTRAINT check_comment_length CHECK (LENGTH(comment) >= 5);

CREATE INDEX idx_meal_ratings_highlighted ON meal_ratings(highlighted);
CREATE INDEX idx_meal_ratings_created_at ON meal_ratings(created_at);
CREATE INDEX idx_meal_ratings_meal_user ON meal_ratings(gericht_id, benutzer_id);
