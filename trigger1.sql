drop TRIGGER IF EXISTS check_vet;
drop TRIGGER IF EXISTS check_phone;
drop TRIGGER IF EXISTS animal_age;
drop FUNCTION if EXISTS num_consults;

delimiter $$

CREATE TRIGGER animal_age BEFORE INSERT ON _animal
    for each ROW
        BEGIN  
           SET new.age=YEAR(CURDATE())-new.birth_year;

END $$

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
        if new.phone IN (SELECT phone FROM _phone_number) THEN
        call this_number_already_assigned_to_another_person();
        END IF;

END $$


CREATE FUNCTION num_consults(animal_name varchar(255), year INTEGER)
    RETURNS INTEGER
        BEGIN
        DECLARE count_consult integer;
        SELECT count(*) into count_consult
        FROM _consult c
        WHERE YEAR(c.date_timestamp)=year AND c.name = animal_name;
        return count_consult;

END $$



delimiter ;


