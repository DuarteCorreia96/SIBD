DROP PROCEDURE IF EXISTS check_consults;
DROP PROCEDURE IF EXISTS check_animals;
DROP PROCEDURE IF EXISTS insert_animal;
DROP PROCEDURE IF EXISTS get_name;

delimiter $$

# Procedimento para procurar as consultas de um animal pelo nome do owner e VAT
CREATE PROCEDURE check_consults(
   IN animal   VARCHAR(255), 
   IN person   VARCHAR(255),
   IN VAT      INT(11)
)
BEGIN
   SELECT c.date_timestamp, c.VAT_client, c.VAT_vet 
   FROM _person p, _animal a, _consult c, _client cl
   WHERE a.name = animal
      AND p.name LIKE CONCAT('%', person, '%')
      AND cl.VAT = VAT
      AND cl.VAT = p.VAT
      AND cl.VAT = a.VAT
      AND a.name = c.name
      AND (p.VAT = c.VAT_owner OR p.VAT = c.VAT_client);
END $$ 

# Procedimento para ver todos os animais de um cliente
CREATE PROCEDURE check_animals(
   IN person   VARCHAR(255),
   IN VAT      INT(11)
)
BEGIN 
   SELECT a.name, a.species_name, YEAR(CURDATE()) - a.birth_year AS age
   FROM _animal a, _person p
   WHERE p.name LIKE CONCAT('%', person, '%') 
      AND p.VAT = VAT
      AND a.VAT = p.VAT;
END $$

# Procedimento para inserir novos animais na database
CREATE PROCEDURE insert_animal(
   IN person      VARCHAR(255),
   IN VAT         INT(11),
   IN animal      VARCHAR(255),
   IN s_name      VARCHAR(255),
   IN b_year      YEAR
)
BEGIN
   INSERT INTO _animal (name, VAT, species_name, birth_year) VALUES 
      (animal, VAT, s_name, b_year);
END $$

# Procedure to get client name from VAT
CREATE PROCEDURE get_name(
   IN VAT_client  INT(11),
   IN person   VARCHAR(255)
)
BEGIN
   SELECT p.name 
   FROM  _person p, _client cl 
   WHERE cl.VAT = p.VAT 
      AND p.VAT = VAT_client
      AND p.name LIKE CONCAT('%', person, '%');
END $$

delimiter ;