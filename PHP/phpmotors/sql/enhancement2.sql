-- Query 1
INSERT INTO clients (
        clientFirstname,
        clientLastname,
        clientEmail,
        clientPassword,
        comment
    )
VALUES (
        'Tony',
        'Stark',
        'tony@starkent.com',
        'IamIronM@n',
        'I am the real Ironman'
    );
-- Query 2
UPDATE clients
SET clientLevel = 3
WHERE clientEmail = 'tony@starkent.com';
-- Query 3
UPDATE inventory
SET invDescription = 'Do you have 6 kids and like to go off-roading? The Hummer gives you the spacious interiors with an engine to get you out of any muddy or rocky situation.'
WHERE invModel = 'Hummer'
    AND invMake = 'GM';
-- Query 4
SELECT invModel
FROM inventory
    INNER JOIN carclassification ON inventory.classificationId = carclassification.classificationId
WHERE classificationName = 'SUV';
-- Query 5
Delete FROM inventory
WHERE invMake = 'Jeep'
    AND invModel = 'Wrangler';
-- Query 6
UPDATE inventory
SET invImage = concat('/phpmotors', invImage),
    invThumbnail = concat('/phpmotors', invThumbnail);