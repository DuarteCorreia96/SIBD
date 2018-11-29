# SIBD

## Alterações
- Query animal inserted, show_consults, animal_inserted e list animals 
- Tirei a lista de animais da pagina start next
- Criei Owner_VAT em start_next
- Troquei client_vat para owner_vat em: list_animals, show_consults, consult_description

## To do List

###  HTML  
- [ ] 1ª parte
  - [x] Form to get:
    - [x] $Client_VAT
    - [x] $Animal_Name
    - [x] $Owner_Name
  - [ ] Check:
    - [x] Client with that VAT
    - [x] $Animal_Name com Owner o com LIKE $Owner_Name
    - [ ] Consultas anteriores com esse animal e client
  - [ ] Create:
    - [ ] Table with animals matching the checks
    - [x] Insert new animal with client being the owner
  
- [x] 2ª parte - Web pages to support the access and registry of information associated to a consult
  - [ ] Clicking on animal should:
    - [ ] Go to another page listing all consults
  - [x] Clicking on consult should:
    - [x] Go to another page showing all info:
      - [x] Characteristics of the animal (e.g., gender, age, weight, etc.)
      - [x] SOAP notes
      - [x] Existing diagnostic codes
      - [x] Existing prescriptions
  - [ ] Option to inclued new consult:
    - [ ] VAT for the veterinary doctor
    - [ ] Animal’s weight
    - [ ] SOAP notes
    - [ ] Diagnostic codes

- [ ] 3ª parte - Web pages to support the registry of information associated to a procedure of the type blood test
  - [ ] On list of consults create option to enter results for a test
  - [ ] Selecting that option should go to page with form:
    - [ ] VAT of the assistant
    - [ ] Values associated to indicators:
      - [ ] White blood cell count
      - [ ] Number of neutrophils
      - [ ] Number of lymphocytes
      - [ ] Number of monocytes
  - [ ] Insertion made in context of single transaction

### Functions, Triggers and Stored Procedures
- [x] Trigger 1
- [ ] Trigger 2
- [ ] Trigger 3
- [ ] Function 1
- [ ] Procedure 1