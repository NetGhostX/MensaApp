-- Create new table for individual ratings
CREATE TABLE meal_ratings (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    meal_id BIGINT NOT NULL,
    user_id BIGINT NOT NULL,
    comment TEXT NOT NULL CHECK (LENGTH(comment) >= 5),
    rating ENUM('sehr gut', 'gut', 'schlecht', 'sehr schlecht') NOT NULL,
    highlighted BOOLEAN NOT NULL DEFAULT FALSE,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (meal_id) REFERENCES gericht(id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES benutzer(id) ON DELETE CASCADE
);

-- Create indices for better performance
CREATE INDEX idx_meal_ratings_highlighted ON meal_ratings(highlighted);
CREATE INDEX idx_meal_ratings_created_at ON meal_ratings(created_at);
CREATE INDEX idx_meal_ratings_meal_user ON meal_ratings(meal_id, user_id);
