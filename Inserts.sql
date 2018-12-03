/*PESSOAS*/
INSERT INTO _person(VAT, name,address_street ,address_city, address_zip  ) VALUES
(023,   'Marco Passarinho',     'Rua dos Piupius',      'Seixal',       '3837-339'),
(057,   'Ines Lopes',           'Rua Maria Adelaide',   'Portalegre',   '3289-292'),
(001,   'Zé Manel',             'Rua de Angola',        'Sintra',       '2556-283'),
(002,   'Duarte Correia',       'Rua São Juliao',       'Lisboa',       '4566-255'),
(003,   'Rafael Forte',         'Rua Fernandes',        'Lisboa',       '2381-279'),
(004,   'Gertrudes da Silva',   'Rua São Juliao',       'Lisboa',       '4566-281'),
(005,   'Marco Paulo',          'Rua Fernandes',        'Lisboa',       '2381-233'),
(006,   'José Nobre',           'Avenida de Macau',     'Sintra',       '2605-811'),
(008,   'John Smith',           'Rua do Brasil',        'Lisboa',       '8666-783'),
(016,   'Poupas Amarelo',       'Rua Sésamo',           'Amadora',      '9342-551'),
(072,   'Maria da Silva',          'Rua de Cabo Verde',    'Lisboa',       '8752-562'),
(007,   'James Bond',           'Rua de Inglaterra',    'Porto',        '5678-923'),
(018,   'Dinis',                'Rua de Inglaterra',    'Lisboa',       '4926-283'),
(043,   'Vlad Yuri',            'Avenida Duque Ávila',  'Lisboa',       '4786-233'),
(082,   'Feliciano',            'Avenida da Liberdade', 'Lisboa',       '4506-253');

/*Clientes*/
INSERT INTO _client VALUES
(023),
(057),
(004),
(072),
(001),
(043),
(018),
(082),
(006),
(008),
(007);

/*VETS*/
INSERT INTO _veterinary (VAT, specialization, bio) VALUES
(002, 'cirurgia', 'Doutorado na Faculdade de Medicina Veterinária'),
(003, 'aves','Doutorado na Faculdade de Medicina Veterinária'),
(008, 'animais de grande porte','Doutorado na Faculdade de Medicina Veterinária'),
(006, 'repteis','Doutorado na Faculdade de Medicina Veterinária');

/*ASSISTANT*/
INSERT INTO _assistant VALUES
(005),
(016),
(043);

/*PhoneNumber*/
INSERT INTO _phone_number VALUES
(965555555, 005),
(924444444, 004),
(933333333, 003),
(921111111, 008),
(922111121, 007),
(935681111, 018),
(925593111, 043);


/*SPECIES*/
INSERT INTO _species(name) VALUES
('bird Terrier'),
('Persa bird'),
('Yorkshire Terrier'),
('German Shepherd'),
('Basset Hound'),
('Dalmatian'),
('bird'),
('Parrot'),
('Poodle'),
('Persa'),
('cat'),
('dog'),
('Pug');

/*Generalization_SPECIES*/
INSERT INTO _generalization_species VALUES
('Persa bird', 'cat'),
('bird Terrier', 'dog'),
('German Shepherd', 'dog'),
('Yorkshire Terrier','dog'),
('Basset Hound','dog'),
('Dalmatian', 'dog'),
('Parrot', 'bird'),
('Persa', 'cat'),
('Pug', 'dog');

/*ANIMAL*/
INSERT INTO _animal (name, VAT, species_name, birth_year, colour, gender) VALUES 
('Maria',       023, 'bird Terrier',       2013,    'Brown',    'Female'),
('Antonito',    057, 'Persa bird',         2000,    'White',    'Male'),
('Diego',       008, 'German Shepherd' ,   2008,    'Brown',    'Male'),
('Totti' ,      004, 'Yorkshire Terrier',  2016,    'Black',    'Male'),
('Totti' ,      072, 'Persa',              2014,    'White',    'Female'),
('Chibanga' ,   006, 'Basset Hound',       2013,    'Brown',    'Male'),
('Gato',        006, 'Pug',                2012,    'Orange',   'Female'),
('Amilcar',     018, 'Parrot',             2015,    'Green',    'Male'),
('Teco',        082, 'Poodle',             2008,    'Brown',    'Male'),
('Ze',          004, 'Basset Hound',       2001,    'Brown',    'Male'),
('Bubu',        018, 'Basset Hound',       2011,    'White',    'Female'),
('Michu',       007, 'Basset Hound',       2012,    'Black',    'Male'),
('Cacu',        006, 'German Shepherd',    2010,    'Brown',    'Female'),
('Alfredo',     007, 'Persa',              2010,    'White',    'Male'),
('Diogo',       082, 'German Shepherd' ,   2005,    'Brown',    'Male');

/*CONSULT*/
INSERT INTO _consult (name,VAT_owner, date_timestamp , o, s, a, p, VAT_client, VAT_vet, weight) VALUES 
('Diego',       008, '2017-08-23  12:55:08', 'obese',       's-2017-08-23',    'a-2017-08-23',    'p-2017-08-23',        004,    003,    20 ),
('Chibanga',    006, '2017-10-10  14:45:08', 'obese',       's-2017-10-10',    'a-2017-10-10',    'p-2017-10-10',        004,    006,    40 ),
('Gato',        006, '2017-09-09  15:45:08', 'obese',       's-2017-09-09',    'a-2017-09-09',    'p-2017-09-09',        004,    003,    35 ),
('Gato',        006, '2017-01-01  12:10:00', 'obese',       's-2017-01-01',    'a-2017-01-01',    'p-2017-01-01',        004,    002,    29 ),
('Totti',       004, '2017-11-03  22:34:56', 'obesity',     's-2017-11-03',    'a-2017-11-03',    'p-2017-11-03',        001,    002,    31 ),
('Totti',       004, '2017-10-03  22:34:56', 'obesity',     's-2017-10-03',    'a-2017-10-03',    'p-2017-10-03',        001,    002,    30 ),
('Totti',       004, '2017-12-03  22:34:56', 'obesity',     's-2017-12-03',    'a-2017-12-03',    'p-2017-12-03',        001,    002,    33 ),
('Totti',       004, '2016-10-03  22:34:56', 'obesity',     's-2016-11-03',    'a-2016-11-03',    'p-2016-11-03',        001,    002,    32 ),
('Amilcar',     018, '2017-10-05  12:24:46', 'faaaat',      's-2017-10-05',    'a-2017-10-05',    'p-2017-10-05',        018,    008,    0.5),
('Teco',        082, '2017-01-03  10:24:26', 'hair loss',   's-2017-01-03',    'a-2017-01-03',    'p-2017-01-03',        043,    008,    10 ),
('Ze',          004, '2017-06-15  10:10:10', 'nice',        's-2017-06-15',    'a-2017-06-15',    'p-2017-06-15',        004,    003,    73 ),
('Michu',       007, '2017-06-05  10:10:10', 'bald',        's-2017-06-05',    'a-2017-06-05',    'p-2017-06-05',        008,    003,    7  ),
('Cacu',        006, '2017-06-05  11:11:11', 'thin',        's-2017-06-05',    'a-2017-06-05',    'p-2017-06-05',        004,    003,    40 ),
('Totti',       072, '2017-05-03  12:22:41', 'hair loss',   's-2017-05-03',    'a-2017-05-03',    'p-2017-05-03',        004,    006,    15 ),
('Bubu',        018, '2017-06-05  09:09:10', 'fat',         's-2017-06-05',    'a-2017-06-05',    'p-2017-06-05',        008,    006,    25 );

/*participation*/
INSERT INTO _participation VALUES 
('Chibanga',    006, '2017-10-10  14:45:08',  005),
('Gato',        006, '2017-01-01  12:10:00',  005),
('Totti',       004, '2017-11-03  22:34:56',  005),
('Amilcar',     018, '2017-10-05  12:24:46',  043),
('Diego',       008, '2017-08-23  12:55:08',  005);

/*Diagnosis_code*/
INSERT INTO _diagnosis_code VALUES 
('code1','ferida'),
('code2','corte'),
('code3','pneumonia'),
('code5','kidney failure'),
('code6','tosse'),
('code7','obstipação'),
('code8','gripe');

/*Consult_diagnosis*/
INSERT INTO _consult_diagnosis VALUES 
('code1', 'Diego', 008, '2017-08-23  12:55:08'),
('code2', 'Diego', 008, '2017-08-23  12:55:08'),
('code1', 'Totti', 004, '2017-11-03  22:34:56'),
('code3', 'Totti', 004, '2017-11-03  22:34:56'),
('code7', 'Teco',  082, '2017-01-03  10:24:26'),
('code3', 'Ze',    004, '2017-06-15  10:10:10'),
('code3', 'Michu', 007, '2017-06-05  10:10:10'),
('code2', 'Cacu',  006, '2017-06-05  11:11:11'),
('code3', 'Bubu',  018, '2017-06-05  09:09:10'),
('code5','Amilcar',018, '2017-10-05  12:24:46');
/*Medication*/
INSERT INTO _medication VALUES
('Bruffen', 'Lab1', '500mg'),
('Paracetamol', 'LabCORP', '100mg'),
('Penicilina', 'LabIndustries', '10mg'),
('AntiEstupidez', 'LabEducacao', '75mg');

/*Prescription*/
INSERT INTO _prescription (code, name, VAT_owner, date_timestamp, name_med, lab, dosage, regime) VALUES 
('code3', 'Totti', 004, '2017-11-03  22:34:56', 'AntiEstupidez',    'LabEducacao',  '75mg',     'Tomar todos os dias 3'),
('code1', 'Totti', 004, '2017-11-03  22:34:56', 'Bruffen',          'Lab1',         '500mg',    'Tomar todos os dias 2'),
('code1', 'Diego', 008, '2017-08-23  12:55:08', 'Paracetamol',      'LabCORP',      '100mg',    'Tomar todos os dias 3'),
('code2', 'Diego', 008, '2017-08-23  12:55:08', 'Paracetamol',      'LabCORP',      '100mg',    'Tomar todos os dias 1'),
('code2', 'Diego', 008, '2017-08-23  12:55:08', 'Penicilina',       'LabIndustries','10mg',     'Tomar todos os dias 3'),
('code1', 'Totti', 004, '2017-11-03  22:34:56', 'Paracetamol',      'LabCORP',      '100mg',    'Tomar todos os dias 3'),
('code1', 'Totti', 004, '2017-11-03  22:34:56', 'Penicilina',       'LabIndustries','10mg',     'Tomar todos os dias 1'),
('code7', 'Teco',  082, '2017-01-03  10:24:26', 'Penicilina',       'LabIndustries','10mg',     'Tomar todos os dias 2');

INSERT INTO _procedure (name,VAT_owner,date_timestamp,num) VALUES
('Teco',        082, '2017-01-03  10:24:26','teste sangue'),
('Amilcar',     018, '2017-10-05  12:24:46','teste sangue'),
('Amilcar',     018, '2017-10-05  12:24:46','teste urina'),
('Michu',       007, '2017-06-05  10:10:10','teste sangue');

INSERT INTO _test_procedure (name,VAT_owner,date_timestamp,num,type) VALUES
('Teco',        082, '2017-01-03  10:24:26','teste sangue','blood'),
('Michu',       007, '2017-06-05  10:10:10','teste sangue','blood'),
('Amilcar',     018, '2017-10-05  12:24:46','teste urina' , 'urine'),
('Amilcar',     018, '2017-10-05  12:24:46','teste sangue', 'blood');


INSERT INTO _performed (name,VAT_owner,date_timestamp,num,VAT_assistant) VALUES
('Teco',        082, '2017-01-03  10:24:26','teste sangue',043),
('Michu',       007, '2017-06-05  10:10:10','teste sangue',005);
/*indicator*/
INSERT INTO _indicator(name, reference_value, units) VALUES 
('White Blood Cells','90' , 'milligrams'),
('Neutrophils',      '120', 'milliliters'),
('Lymphocytes',      '101', 'milligrams'),
('Monocytes',        '130', 'milligrams'),
('indicadorE',       '125', 'milligrams'),
('creatine level',   '0.8', 'milligrams');

INSERT INTO _produced_indicator(name,VAT_owner,date_timestamp,num,indicator_name,value) VALUES
('Teco',        082, '2017-01-03  10:24:26','teste sangue', 'White Blood Cells', 87),
('Teco',        082, '2017-01-03  10:24:26','teste sangue', 'Neutrophils',       130),
('Teco',        082, '2017-01-03  10:24:26','teste sangue', 'creatine level',    0.8),
('Amilcar',     018, '2017-10-05  12:24:46','teste urina' , 'Monocytes',         110),
('Amilcar',     018, '2017-10-05  12:24:46','teste sangue', 'indicadorE',        187),
('Amilcar',     018, '2017-10-05  12:24:46','teste sangue', 'creatine level',    1.3),
('Michu',       007, '2017-06-05  10:10:10','teste sangue', 'creatine level',    1.2);
