<?php
//Constants used for database connection
define('DB_HOST','localhost');
define('DB_USER','root');
define('DB_PASSWORD','');
define('DB_NAME','kitchcheck');

//Constants used for Employee creation with status response codes, creation begins with 1. 
define('EMPLOYEE_CREATED',101);
define('EMPLOYEE_EXISTS',102);
define('EMPLOYEE_FAILURE',103);

//Constants used for Manager creation
define('MANAGER_CREATED',104);
define('MANAGER_FAILURE',105);
define('MANAGER_EXISTS',106);
define('EMPLOYEE_NOTEXIST',107);

//Constants used for Unit creation
define('UNIT_CREATED',108);
define('UNIT_FAILURE',109);
define('UNIT_EXISTS',110);
define('MANAGER_NOTEXIST',111);
 
//Constants used for NonAppCleaningDuty creation
define('NONAPPCLEANINGDUTY_CREATED',112);
define('NONAPPCLEANINGDUTY_FAILURE',113);
define('UNIT_NOTEXIST',114);
 
//Constants used for NonAppTemperature creation
define('NONAPPTEMPERATURE_CREATED',115);
define('NONAPPTEMPERATURE_FAILURE',116);

//Constants used for RiskNonAppTemperature creation
define('RISKNONAPPTEMPERATURE_CREATED',117);
define('RISKNONAPPTEMPERATURE_FAILURE',118);

//Constants used for AppCleaningDuty creation
define('APPCLEANINGDUTY_CREATED',119);
define('APPCLEANINGDUTY_FAILURE',120);

//Constants used for AppTemperature creation
define('APPTEMPERATURE_CREATED',121);
define('APPTEMPERATURE_FAILURE',122);

//Constants used for RiskAppTemperature creation
define('RISKAPPTEMPERATURE_CREATED',123);
define('RISKAPPTEMPERATURE_FAILURE',124);

//Constants Used for Manager Verification, read methods begin with 2. 
define('MANAGER_VERIFIED',201);
define('EMPLOYEE_VERIFIED',202);
define('EMPLOYEE_NOT_FOUND',203);

//Constants Used for Password Verification.
define('EMPLOYEE_ACCEPTED',204);
define('EMPLOYEE_INVALID',205);

//Constants Used for Employee Update, update methods begin with 3. 
define('EMPLOYEE_UPDATED',301);
define('EMPLOYEE_NOTUPDATED',302);

//Constants Used for Password Update. 
define('PASSWORD_UPDATED',303);
define('PASSWORD_UNCHANGED',304);
define('PASSWORD_INVALID',305);

//Constants Used for Manager Update.
define('MANAGER_UPDATED',306);
define('MANAGER_NOTUPDATED',307);

//Constants Used for UNIT Update.
define('UNIT_UPDATED',308);
define('UNIT_NOTUPDATED',309);

//Constants used for Employee Deletion, delete methods begin with 4.
define('EMPLOYEE_DELETED',401);
define('EMPLOYEE_UNCHANGED',402);
define('EMPLOYEE_NEEDED',403);
define('DELETE_MANAGER_FIRST',404);

//Constants Used for Manager Deletion. 
define('MANAGER_DELETED',405);
define('MANAGER_UNCHANGED',406);
define('MANAGER_NEEDED',407);

//Constants Used for NONClean delete.
define('NONAPPCLEAN_DELETED',408);
define('NONAPPCLEAN_UNCHANGED',409);

//Constants Used for NONTemp delete.
define('NONAPPTEMP_DELETED',410);
define('NONAPPTEMP_UNCHANGED',411);

//Constants Used for RISKNONAPPTEMP delete.
define('RISKNONAPPTEMP_DELETED',412);
define('RISKNONAPPTEMP_UNCHANGED',413);

//Constants Used for APPCLEAN delete.
define('APPCLEAN_DELETED',414);
define('APPCLEAN_UNCHANGED',415);

//Constants Used for APPTEMP delete.
define('APPTEMP_DELETED',416);
define('APPTEMP_UNCHANGED',417);

//Constants Used for RISKAPPTEMP delete.
define('RISKAPPTEMP_DELETED',418);
define('RISKAPPTEMP_UNCHANGED',419);

//Constants Used for APPCLEAN delete.
define('APPCLEANTIME_DELETED',420);
define('APPCLEANTIME_UNCHANGED',421);

//Constants Used for APPTEMP delete.
define('APPTEMPTIME_DELETED',422);
define('APPTEMPTIME_UNCHANGED',423);

//Constants Used for RISKAPPTEMP delete.
define('RISKAPPTEMPTIME_DELETED',424);
define('RISKAPPTEMPTIME_UNCHANGED',425);

?>