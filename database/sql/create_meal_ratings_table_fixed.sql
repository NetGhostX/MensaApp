-- First, check and create the meal_ratings table with matching column types
CREATE TABLE meal_ratings (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    gericht_id BIGINT NOT NULL COMMENT 'Reference to gericht table',
    benutzer_id BIGINT NOT NULL COMMENT 'Reference to benutzer table',
    comment TEXT NOT NULL CHECK (LENGTH(comment) >= 5),
    rating ENUM('sehr gut', 'gut', 'schlecht', 'sehr schlecht') NOT NULL,
    highlighted BOOLEAN NOT NULL DEFAULT FALSE,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_meal_rating_gericht 
        FOREIGN KEY (gericht_id) 
        REFERENCES gericht(id) 
        ON DELETE CASCADE,
    CONSTRAINT fk_meal_rating_benutzer 
        FOREIGN KEY (benutzer_id) 
        REFERENCES benutzer(id) 
        ON DELETE CASCADE
);

-- Create indices for better performance
CREATE INDEX idx_meal_ratings_highlighted ON meal_ratings(highlighted);
CREATE INDEX idx_meal_ratings_created_at ON meal_ratings(created_at);
CREATE INDEX idx_meal_ratings_meal_user ON meal_ratings(gericht_id, benutzer_id);
