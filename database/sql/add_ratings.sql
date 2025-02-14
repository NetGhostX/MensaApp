-- Add rating column to gericht table if it doesn't exist
ALTER TABLE gericht
ADD COLUMN IF NOT EXISTS rating DECIMAL(3,1) DEFAULT 0.0 
COMMENT 'Rating of the meal from 0.0 to 5.0';

-- Create index for rating column
CREATE INDEX idx_gericht_rating ON gericht(rating);

-- Add some sample ratings to existing meals
UPDATE gericht 
SET rating = ROUND(RAND() * 3 + 2, 1) 
WHERE rating = 0;

-- Ensure ratings stay within 0-5 range
ALTER TABLE gericht
ADD CONSTRAINT chk_rating_range 
CHECK (rating >= 0 AND rating <= 5);
