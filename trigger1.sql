delimiter $$

CREATE TRIGGER check_vet BEFORE INSERT ON _veterinary
    for each row 
    BEGIN
        if new.VAT IN (SELECT * FROM _assistant) THEN
        call this_vat_belongs_to_assistant();
        end IF;

END $$


CREATE TRIGGER check_phone BEFORE INSERT ON _phone_number
    for each ROW
    BEGIN
        if new._phone_number IN (SELECT * FROM _phone_number) THEN
        call this_number_already_assigned_to_another_person();
        END IF;

END $$


CREATE FUNCTION num_consults(animal_name varchar(255), year INTEGER)
    RETURNS INTEGER
        BEGIN
        DECLARE count_consult integer;
        SELECT count(*) into count_consult
        FROM _consult c
        WHERE YEAR(c.date_timestamp)=year;
        return count_consult

END $$

