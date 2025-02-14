-- Drop the unique constraint if it exists (since users can now rate multiple times)
ALTER TABLE meal_ratings
DROP INDEX IF EXISTS meal_ratings_meal_id_user_id_unique;

-- Add new columns for comment, rating type, and highlight flag
ALTER TABLE meal_ratings
ADD COLUMN comment TEXT NOT NULL CHECK (LENGTH(comment) >= 5),
MODIFY COLUMN rating ENUM('sehr gut', 'gut', 'schlecht', 'sehr schlecht') NOT NULL,
ADD COLUMN highlighted BOOLEAN NOT NULL DEFAULT FALSE,
ADD COLUMN created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP;

-- Create index for highlighted ratings to quickly find them for homepage
CREATE INDEX idx_highlighted_ratings ON meal_ratings(highlighted);

-- Create index for the timestamp to sort by newest
CREATE INDEX idx_rating_date ON meal_ratings(created_at DESC);
