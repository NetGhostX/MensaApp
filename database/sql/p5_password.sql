-- Create admin user with salted SHA-1 password
-- Password: test
-- Salt: emensa2023
-- Final string to hash: testemensa2023
INSERT INTO benutzer (
    name,
    email,
    passwort,
    admin,
    anzahlfehler,
    anzahlanmeldungen,
    letzteanmeldung,
    letzterfehler
) VALUES (
    'Administrator',
    'admin@emensa.example',
    SHA1(CONCAT('test', 'emensa2023')), -- Concatenate password with salt before hashing
    TRUE, -- Is admin
    0,    -- No login errors
    0,    -- No successful logins yet
    NULL, -- No last login
    NULL  -- No last error
);

-- For documentation purposes (commented out):
-- SELECT SHA1('testemensa2023') as hashed_password;
-- This produces: 'dcf35c2f5abef41b7b6c8d65ea126c424e039924'
