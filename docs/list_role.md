# Role's list and caracteristics
## 'anonymous'
Consult the results of any competition of any championship./
By default, the see the last competition played for a select championship defined in constants table
## ROLE_USER 
No role has been defined./
Some connected with this role could access to his history. 
## ROLE_ORGA
Manages a competition :
- define the course
- define the competitors
- launch competition
- enter results
- publish results
## ROLE_ORGA_CHAMP
Inherites of ROLE_ORGA
Create competition for a championship
## ROLE_ADMIN
Inherites of ROLE_CHAMP
## ROLE_SUPER_ADMIN
Inherites of ROLE_CHAMPS
Can roles' change for debugging
