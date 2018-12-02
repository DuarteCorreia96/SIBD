# SIBD

## Alterações
- Query animal inserted, show_consults, animal_inserted e list animals 
- Tirei a lista de animais da pagina start next
- Criei Owner_VAT em start_next
- Troquei client_vat para owner_vat em: list_animals, show_consults, consult_description
- Permite adicionar consultas quando encontra o animal.

## Bugs e problemas:
- Garantir valores (por exemplo data da consulta não antes do animal ter nascido, etc)

## To do List
- Perguntar ao Professor se na criação da consulta se cria um código (nao faz muito sentido, os codigos deviam
estar pre defenidor), ou um consult_diagnosis. E Se é apenas um, ou mais.


###  HTML  
- [x] 1ª parte
  - [x] Form to get:
    - [x] $Client_VAT
    - [x] $Animal_Name
    - [x] $Owner_Name
  - [x] Check:
    - [x] Client with that VAT
    - [x] $Animal_Name com Owner o com LIKE $Owner_Name
    - [x] Consultas anteriores com esse animal e client
  - [x] Create:
    - [x] Table with animals matching the checks
    - [x] Insert new animal with client being the owner
  
- [ ] 2ª parte - Web pages to support the access and registry of information associated to a consult
  - [x] Clicking on animal should:
    - [x] Go to another page listing all consults
  - [x] Clicking on consult should:
    - [x] Go to another page showing all info:
      - [x] Characteristics of the animal (e.g., gender, age, weight, etc.)
      - [x] SOAP notes
      - [x] Existing diagnostic codes
      - [x] Existing prescriptions
  - [x] Option to inclued new consult:
    - [x] VAT for the veterinary doctor
    - [x] Animal’s weight
    - [x] SOAP notes
    - [x] Diagnostic codes

- [ ] 3ª parte - Web pages to support the registry of information associated to a procedure of the type blood test
  - [x] On list of consults create option to enter results for a test
  - [x] Selecting that option should go to page with form:
    - [x] VAT of the assistant
    - [ ] Values associated to indicators:
      - [ ] White blood cell count
      - [ ] Number of neutrophils
      - [ ] Number of lymphocytes
      - [ ] Number of monocytes
  - [x] Insertion made in context of single transaction

### Functions, Triggers and Stored Procedures
- [x] Trigger 1
- [x] Trigger 2
- [x] Trigger 3
- [x] Function 1
- [x] Procedure 1
