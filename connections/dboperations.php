<?php
//Class for database operations
class dboperations{
    private $connection;

    //Constructor for connection
    function __construct(){
        require_once dirname(__FILE__) . '/dbconnections.php';
        $db = new dbconnections;
        $this->connection = $db->connect();
        
    }

    //CREATE METHODS
        //Function for creating new Employee in database
        public function createEmployee($employeeID,$employeeName,$employeePassword){
            if(!$this->checkEmployeeExists($employeeID)){ //if ID not found in database create Employee
                $stmt = $this->connection->prepare("INSERT INTO employee ( EmployeeID, EmployeeName, EmployeePassword) VALUES(?, ?, ?)" );
                $stmt->bind_param("iss", $employeeID,$employeeName,$employeePassword); //bind parameters to string 's' and int 'i'

                if($stmt->execute()){
                    return EMPLOYEE_CREATED; //Return Created response
                } else{
                    return EMPLOYEE_FAILURE; //Return Failure response
                }
            } 
            return EMPLOYEE_EXISTS; //Return already exists response
        }
        //Function for creating new Manager in database
         public function createManager($managerID,$employeeID,$managerName){
            if($this->checkEmployeeExists($employeeID)){ //if ID found in database create Employee
                if(!$this->checkManagerIDExists($managerID)){ //if Manager not found in database create user
                    $stmt = $this->connection->prepare("INSERT INTO manager ( ManagerID, EmployeeID, ManagerName) VALUES(?, ?, ?)" );
                    $stmt->bind_param("iis", $managerID,$employeeID,$managerName); //bind parameters to string 's' and int 'i'
    
                    if($stmt->execute()){
                        return MANAGER_CREATED; //Return Created response
                    } else{
                        return MANAGER_FAILURE; //Return Failure response
                    }
                } 
                return MANAGER_EXISTS; //Return Manager exists response
            } 
            return EMPLOYEE_NOTEXIST; //Return does not exist response
        } 
        //Function for creating new Unit in database
        public function createUnit($unitID,$location,$unitName,$managerID){
            if($this->checkManagerExists($managerID)){ //if manager found in database create Employee
                if(!$this->checkUnitIDExists($unitID)){ //if unit not found in database create unit
                    $stmt = $this->connection->prepare("INSERT INTO unit ( UnitID, Location, UnitName, ManagerID) VALUES(?, ?, ?,?)" );
                    $stmt->bind_param("issi", $unitID,$location,$unitName,$managerID); //bind parameters to string 's' and int 'i'
    
                    if($stmt->execute()){
                        return UNIT_CREATED; //Return Created response
                    } else{
                        return UNIT_FAILURE; //Return Failure response
                    }
                } 
                return UNIT_EXISTS; //Return Unit exists response
            } 
            return MANAGER_NOTEXIST; //Return does not exist response
        } 
        //note: bind boolean as int 0=false, 1=true
        //Function for creating new nonAppCleaningDuty in database
        public function createnonAppCleaningDuty($cleaningDuty,$dutyDate,$employeeID,$unitID,$completion){
            if($this->checkUnitIDExists($unitID)){ //if unit found in database create Entry
                $stmt = $this->connection->prepare("INSERT INTO nonappcleaningduty ( CleaningDuty, DutyDate, EmployeeID, UnitID, CompletionStatus) VALUES(?, ?, ?, ?, ?)" );
                $stmt->bind_param("ssiii", $cleaningDuty,$dutyDate,$employeeID,$unitID,$completion); //bind parameters to string 's' and int 'i'
    
                if($stmt->execute()){
                return NONAPPCLEANINGDUTY_CREATED; //Return Created response
                } 
                return NONAPPCLEANINGDUTY_FAILURE; //Return Failure response
            } 
            return UNIT_NOTEXIST; //Return does not exist response
        } 
        //Function for creating new nonAppTemperature in database
        public function createnonAppTemperature($itemName,$itemTemperature,$temperatureDate,$temperatureTime,$unitID,$employeeID){
            if($this->checkUnitIDExists($unitID)){ //if unit found in database create Entry
                $stmt = $this->connection->prepare("INSERT INTO nonapptemperature ( ItemName, ItemTemperature, TemperatureDate, TemperatueTime, UnitID, EmployeeID) VALUES(?, ?, ?, ?, ?, ?)" );
                $stmt->bind_param("ssssii", $itemName,$itemTemperature,$temperatureDate,$temperatureTime,$unitID,$employeeID); //bind parameters to string 's' and int 'i'
    
                if($stmt->execute()){
                return NONAPPTEMPERATURE_CREATED; //Return Created response
                } 
                return NONAPPTEMPERATURE_FAILURE; //Return Failure response
            } 
            return UNIT_NOTEXIST; //Return does not exist response
        } 
        //Function for creating new risknonAppTemperature in database
        public function createriskNonAppTemperature($itemName,$itemTemperature,$temperatureDate,$temperatureTime,$unitID,$employeeID){
            if($this->checkUnitIDExists($unitID)){ //if unit found in database create Entry
                $stmt = $this->connection->prepare("INSERT INTO risknonapptemperature ( ItemName, ItemTemperature, TemperatureDate, TemperatueTime, UnitID, EmployeeID) VALUES(?, ?, ?, ?, ?, ?)" );
                $stmt->bind_param("ssssii", $itemName,$itemTemperature,$temperatureDate,$temperatureTime,$unitID,$employeeID); //bind parameters to string 's' and int 'i'
    
                if($stmt->execute()){
                return RISKNONAPPTEMPERATURE_CREATED; //Return Created response
                } 
                return RISKNONAPPTEMPERATURE_FAILURE; //Return Failure response
            } 
            return UNIT_NOTEXIST; //Return does not exist response
        } 
           //Function for creating new AppCleaningDuty in database
           public function createAppCleaningDuty($cleaningDuty,$dutyDate,$managerID,$unitID,$completion){
            if($this->checkUnitIDExists($unitID)){ //if unit found in database create Entry
                $stmt = $this->connection->prepare("INSERT INTO appcleaningduty ( CleaningDuty, DutyDate, ManagerID, UnitID, CompletionStatus) VALUES(?, ?, ?, ?, ?)" );
                $stmt->bind_param("ssiii", $cleaningDuty,$dutyDate,$managerID,$unitID,$completion); //bind parameters to string 's' and int 'i'
    
                if($stmt->execute()){
                return APPCLEANINGDUTY_CREATED; //Return Created response
                } 
                return APPCLEANINGDUTY_FAILURE; //Return Failure response
            } 
            return UNIT_NOTEXIST; //Return does not exist response
        } 
         //Function for creating new AppTemperature in database
         public function createAppTemperature($itemName,$itemTemperature,$temperatureDate,$temperatureTime,$unitID,$managerID){
            if($this->checkUnitIDExists($unitID)){ //if unit found in database create Entry
                $stmt = $this->connection->prepare("INSERT INTO apptemperature ( ItemName, ItemTemperature, TemperatureDate, TemperatueTime, UnitID, ManagerID) VALUES(?, ?, ?, ?, ?, ?)" );
                $stmt->bind_param("ssssii", $itemName,$itemTemperature,$temperatureDate,$temperatureTime,$unitID,$managerID); //bind parameters to string 's' and int 'i'
    
                if($stmt->execute()){
                return APPTEMPERATURE_CREATED; //Return Created response
                } 
                return APPTEMPERATURE_FAILURE; //Return Failure response
            } 
            return UNIT_NOTEXIST; //Return does not exist response
        }
        //Function for creating new riskAppTemperature in database
        public function createriskAppTemperature($itemName,$itemTemperature,$temperatureDate,$temperatureTime,$unitID,$managerID){
            if($this->checkUnitIDExists($unitID)){ //if unit found in database create Entry
                $stmt = $this->connection->prepare("INSERT INTO riskapptemperature ( ItemName, ItemTemperature, TemperatureDate, TemperatueTime, UnitID, ManagerID) VALUES(?, ?, ?, ?, ?, ?)" );
                $stmt->bind_param("ssssii", $itemName,$itemTemperature,$temperatureDate,$temperatureTime,$unitID,$managerID); //bind parameters to string 's' and int 'i'

                if($stmt->execute()){
                return RISKAPPTEMPERATURE_CREATED; //Return Created response
                } 
                return RISKAPPTEMPERATURE_FAILURE; //Return Failure response
            } 
            return UNIT_NOTEXIST; //Return does not exist response
        }
    //Create Methods End
    
    //READ Methods Start

    //Function for Manager Verification
    public function verifyManager($employeeID){
        if($this->checkEmployeeExists($employeeID)){
            if($this->checkManagerbyEmployeeIDExists($employeeID)){
                return MANAGER_VERIFIED; //Manager Verification Successfu
            }else{
                return EMPLOYEE_VERIFIED; //Manager Verification Not Successful
            }
        }else{
            return EMPLOYEE_NOT_FOUND; //EmployeeID not found in database
        }
    }
    //Function for getting all Units
    public function getallUnits(){
        $stmt =$this->connection->prepare("SELECT UnitID, Location, UnitName, ManagerID FROM unit LIMIT 10");
        $stmt->execute();
        $stmt->bind_result($unitID, $location, $unitName, $managerID);
        $units = array();
        while($stmt->fetch()){
        $unit = array();
        $unit['UnitID']=$unitID;
        $unit['Location']=$location;
        $unit['UnitName']=$unitName;
        $unit['ManagerID']=$managerID;
        array_push($units,$unit);
        }
        return $units;
    }   
    //Function for getting all Non Approved Cleaning Duties
    public function getallNonApprovedCleaningDutybyID($unitID){
        $stmt =$this->connection->prepare("SELECT NonAppCleaningDutyID, CleaningDuty, DutyDate, EmployeeID, UnitID, CompletionStatus FROM nonappcleaningduty where UnitID=?");
        $stmt->bind_param("i", $unitID); //Bind parameter to i
        $stmt->execute();
        $stmt->bind_result($nonappcleaningdutyID,$cleaningDuty,$dutyDate,$employeeID,$unitID,$completion);
        $nonappcleaningduties = array();
        while($stmt->fetch()){
            $nonappcleaningduty = array();
            $nonappcleaningdutyID=$nonappcleaningduty['NonAppCleaningDutyID'];
            $cleaningDuty = $nonappcleaningduty['CleaningDuty'];
			$dutyDate = $nonappcleaningduty['DutyDate'];
			$employeeID = $nonappcleaningduty['EmployeeID'];
			$unitID = $nonappcleaningduty['UnitID'];
			$completion = $nonappcleaningduty['CompletionStatus'];
            array_push($nonappcleaningduties,$nonappcleaningduty);
        }
        return $nonappcleaningduties;
    }   
     //Function for getting all Non Approved Temperatures
     public function getallNonApprovedTempeaturesbyID($unitID){
        $stmt =$this->connection->prepare("SELECT NonAppTemperatureID, ItemName, ItemTemperature, TemperatureDate, TemperatueTime, UnitID, EmployeeID FROM nonapptemperature where UnitID=?");
        $stmt->bind_param("i", $unitID); //Bind parameter to i
        $stmt->execute();
        $stmt->bind_result($nonapptemperatureID,$itemName,$itemTemperature,$temperatureDate,$temperatureTime,$unitID,$employeeID);
        $nonapptemperatures = array();
        while($stmt->fetch()){
            $nonapptemperature = array();
            $nonapptemperatureID=$nonapptemperature['NonAppTemperatureID'];
            $itemName = $nonapptemperature['ItemName'];
			$itemTemperature =$nonapptemperature['ItemTemperature'];
			$temperatureDate =$nonapptemperature['TemperatureDate'];
			$temperatureTime= $nonapptemperature['TemperatueTime'];
			$unitID = $nonapptemperature['UnitID'];
			$employeeID = $nonapptemperature['EmployeeID'];
            array_push($nonapptemperatures,$nonapptemperature);
        }
        return $nonapptemperatures;
    }   
     //Function for getting all Non Approved Risk Temperatures
     public function getallRiskNonApprovedTempeaturesbyID($unitID){
        $stmt =$this->connection->prepare("SELECT RiskNonAppTemperatureID, ItemName, ItemTemperature, TemperatureDate, TemperatueTime, UnitID, EmployeeID FROM risknonapptemperature where UnitID=?");
        $stmt->bind_param("i", $unitID); //Bind parameter to i
        $stmt->execute();
        $stmt->bind_result($risknonapptemperatureID,$itemName,$itemTemperature,$temperatureDate,$temperatureTime,$unitID,$employeeID);
        $risknonapptemperatures = array();
        while($stmt->fetch()){
            $risknonapptemperature = array();
            $risknonapptemperatureID=$risknonapptemperature['RiskNonAppTemperatureID'];
            $itemName = $risknonapptemperature['ItemName'];
			$itemTemperature =$risknonapptemperature['ItemTemperature'];
			$temperatureDate =$risknonapptemperature['TemperatureDate'];
			$temperatureTime= $risknonapptemperature['TemperatueTime'];
			$unitID = $risknonapptemperature['UnitID'];
			$employeeID = $risknonapptemperature['EmployeeID'];
            array_push($risknonapptemperatures,$risknonapptemperature);
        }
        return $risknonapptemperatures;
    }   
    //Function for getting all Approved Cleaning Duties
    public function getallApprovedCleaningDutybyID($unitID){
        $stmt =$this->connection->prepare("SELECT AppCleaningDutyID, CleaningDuty, DutyDate, EmployeeID, UnitID, CompletionStatus FROM appcleaningduty where UnitID=?");
        $stmt->bind_param("i", $unitID); //Bind parameter to i
        $stmt->execute();
        $stmt->bind_result($appcleaningdutyID,$cleaningDuty,$dutyDate,$employeeID,$unitID,$completion);
        $appcleaningduties = array();
        while($stmt->fetch()){
            $appcleaningduty = array();
            $appcleaningdutyID=$appcleaningduty['AppCleaningDutyID'];
            $cleaningDuty = $appcleaningduty['CleaningDuty'];
			$dutyDate = $appcleaningduty['DutyDate'];
			$employeeID = $appcleaningduty['EmployeeID'];
			$unitID = $appcleaningduty['UnitID'];
			$completion = $appcleaningduty['CompletionStatus'];
            array_push($appcleaningduties,$appcleaningduty);
        }
        return $appcleaningduties;
    } 
     //Function for getting all Approved Temperatures
     public function getallApprovedTempeaturesbyID($unitID){
        $stmt =$this->connection->prepare("SELECT AppTemperatureID, ItemName, ItemTemperature, TemperatureDate, TemperatureTime, UnitID, EmployeeID FROM apptemperature where UnitID=?");
        $stmt->bind_param("i", $unitID); //Bind parameter to i
        $stmt->execute();
        $stmt->bind_result($apptemperatureID,$itemName,$itemTemperature,$temperatureDate,$temperatureTime,$unitID,$employeeID);
        $apptemperatures = array();
        while($stmt->fetch()){
            $apptemperature = array();
            $apptemperatureID=$apptemperature['AppTemperatureID'];
            $itemName = $apptemperature['ItemName'];
			$itemTemperature =$apptemperature['ItemTemperature'];
			$temperatureDate =$apptemperature['TemperatureDate'];
			$temperatureTime= $apptemperature['TemperatueTime'];
			$unitID = $apptemperature['UnitID'];
			$employeeID = $apptemperature['EmployeeID'];
            array_push($apptemperatures,$apptemperature);
        }
        return $apptemperatures;
    }   
      //Function for getting all Approved Risk Temperatures
      public function getallRiskApprovedTempeaturesbyID($unitID){
        $stmt =$this->connection->prepare("SELECT RiskAppTemperatureID, ItemName, ItemTemperature, TemperatureDate, TemperatureTime, UnitID, ManagerID FROM riskapptemperature where UnitID=? LIMIT 10");
        $stmt->bind_param("i", $unitID); //Bind parameter to i
        $stmt->execute();
        $stmt->bind_result($riskapptemperatureID,$itemName,$itemTemperature,$temperatureDate,$temperatureTime,$unitID,$employeeID);
        $riskapptemperatures = array();
        while($stmt->fetch()){
            $riskapptemperature = array();
            $riskapptemperatureID=$riskapptemperature['RiskAppTemperatureID'];
            $itemName = $riskapptemperature['ItemName'];
			$itemTemperature =$riskapptemperature['ItemTemperature'];
			$temperatureDate =$riskapptemperature['TemperatureDate'];
			$temperatureTime= $riskapptemperature['TemperatueTime'];
			$unitID = $riskapptemperature['UnitID'];
			$employeeID = $riskapptemperature['EmployeeID'];
            array_push($riskapptemperatures,$riskapptemperature);
        }
        return $riskapptemperatures;
    }   
    //Function for Password Verification
    public function verifyPassword($employeeID,$employeePassword){
        if($this->checkEmployeeExists($employeeID)){
            $hashed_password= $this->getPasswordByEmployeeID($employeeID); //Get employee password from database
            if(password_verify($employeePassword, $hashed_password)){ //Verify encrypted password to received password
            return EMPLOYEE_ACCEPTED; //Verification Successful
            }else{
            return EMPLOYEE_INVALID; //Verification Unsuccessful
            }
        }else{
            return EMPLOYEE_NOT_FOUND; //EmployeeID not found in database
        }
    }
    //function for getting Employee info by ID
    public function getEmployeebyID($employeeID){
        $stmt =$this->connection->prepare("SELECT  EmployeeID, EmployeeName FROM employee WHERE EmployeeID = ?");
        $stmt->bind_param("i", $employeeID);
        $stmt->execute();
        $stmt->bind_result($employeeID, $employeeName);
        $stmt->fetch();
        $employee = array();
        $employee['EmployeeID']=$employeeID;
        $employee['EmployeeName']=$employeeName;
        return $employee;
    }   
   //function for getting Manager info by ID
   public function getManagerbyID($managerID){
    $stmt =$this->connection->prepare("SELECT  ManagerID, ManagerName, EmployeeID FROM manager WHERE ManagerID = ?");
    $stmt->bind_param("i", $managerID);
    $stmt->execute();
    $stmt->bind_result($managerID, $managerName, $employeeID);
    $stmt->fetch();
    $manager = array();
    $manager['ManagerID']=$managerID;
    $manager['ManagerName']=$managerName;
    $manager['EmployeeID']=$employeeID;
    return $manager;
    }   
    //READ OPERATIONS COMPLETE
    //UPDATE OPERATIONS START
    //Function for updating Employee information
     public function updateEmployeeInfoManagerView( $employeeID, $employeeName, $employeePassword){
        if($this->checkEmployeeExists($employeeID)){
        $stmt =$this->connection->prepare("UPDATE employee SET EmployeeName=?, EmployeePassword=? WHERE EmployeeID=?");
        $stmt->bind_param("ssi", $employeeName, $employeePassword, $employeeID);
        if($stmt->execute()){
            return EMPLOYEE_UPDATED;
        }else{
            return EMPLOYEE_NOTUPDATED;
        }
        }else {
            return EMPLOYEE_NOTEXIST;
        } 
    }
    //Function for Updating Employee Password
    public function updatePassword($currentPassword, $newPassword, $employeeID){
        $hashed_password=$this->getPasswordByEmployeeID($employeeID);

        if(password_verify($currentPassword,$hashed_password)){
            $hash_password=password_hash($newPassword, PASSWORD_DEFAULT);
            $stmt=$this->connection->prepare("UPDATE employee SET EmployeePassword=? WHERE EmployeeID");
            $stmt->bind_param('si', $hash_password, $employeeID);

            if($stmt->execute()){
                return PASSWORD_UPDATED;
            } else{ 
                return PASSWORD_UNCHANGED;
            }

        } else{
            return PASSWORD_INVALID;
        }
    }
    //Function for updating Manager information
    public function updateManager( $managerID,$managerName){
        if($this->checkManagerIDExists($managerID)){
            $stmt =$this->connection->prepare("UPDATE manager SET ManagerName=? WHERE ManagerID=?");
            $stmt->bind_param("si", $managerName, $managerID);
        if($stmt->execute()){
            return MANAGER_UPDATED;
        }else{
            return MANAGER_NOTUPDATED;
        }
        }else {
            return MANAGER_NOTEXIST;
        } 
    }
    //Function for updating UNIT information
    public function updateUnit( $unitID,$location,$unitName,$managerID){
        if($this->checkUnitIDExists($unitID)){
            if($this->checkManagerIDExists($managerID)){
                $stmt =$this->connection->prepare("UPDATE unit SET Location=?, UnitName=?, ManagerID=? WHERE UnitID=?");
                $stmt->bind_param("ssii", $location,$unitName,$managerID,$unitID);
            if($stmt->execute()){
                return UNIT_UPDATED;
            }else{
                return UNIT_NOTUPDATED;
            }
            }else {
                return MANAGER_NOTEXIST;
            } 
    } return UNIT_NOTEXIST;
}
//UPDATE METHODS END
//DELETE METHODS START  
    public function deleteEmployee($employeeID){
        if(!$this->checkManagerbyEmployeeIDExists($employeeID)){
            if(!$this->checkEmployeeinCleaning($employeeID)&&!$this->checkEmployeeinTemp($employeeID)&&!$this->checkEmployeeinRiskTemp($employeeID)){ 
                $stmt = $this->connection->prepare("DELETE FROM employee WHERE EmployeeID = ?");
                $stmt->bind_param("i", $employeeID);
                if($stmt->execute()){
                    return EMPLOYEE_DELETED; 
                }else{
                    return EMPLOYEE_UNCHANGED;
                }
            } return EMPLOYEE_NEEDED;
        } return DELETE_MANAGER_FIRST;
    }
    public function deleteManager($managerID){
        if(!$this->checkManagerinCleaning($managerID)&&!$this->checkManagerinTemp($managerID)&&!$this->checkManagerinRiskTemp($managerID)){ 
            $stmt = $this->connection->prepare("DELETE FROM manager WHERE ManagerId = ?");
            $stmt->bind_param("i", $managerID);
            if($stmt->execute()){
                return MANAGER_DELETED; 
            }else{
                return MANAGER_UNCHANGED;
            }
        } return MANAGER_NEEDED;
    }
    public function deletenonappcleaningduty($nonAppCleaningDutyID){
        $stmt = $this->connection->prepare("DELETE FROM nonappcleaningduty WHERE NonAppCleaningDutyID = ?");
        $stmt->bind_param("i", $nonAppCleaningDutyID);
        if($stmt->execute()){
            return NONAPPCLEAN_DELETED; 
        }else{
            return NONAPPCLEAN_UNCHANGED;
        }
    }
    public function deletenonapptemperature($nonAppTemperatureID){
        $stmt = $this->connection->prepare("DELETE FROM nonapptemperature WHERE NonAppTemperatureID = ?");
        $stmt->bind_param("i", $nonAppTemperatureID);
        if($stmt->execute()){
            return NONAPPTEMP_DELETED; 
        }else{
            return NONAPPTEMP_UNCHANGED;
        }
    }
    public function deleterisknonapptemperature($riskNonAppTemperatureID){
        $stmt = $this->connection->prepare("DELETE FROM risknonapptemperature WHERE RiskNonAppTemperatureID = ?");
        $stmt->bind_param("i", $riskNonAppTemperatureID);
        if($stmt->execute()){
            return RISKNONAPPTEMP_DELETED; 
        }else{
            return RISKNONAPPTEMP_UNCHANGED;
        }
    }
    public function deleteappcleaningduty($appCleaningDutyID){
        $stmt = $this->connection->prepare("DELETE FROM appcleaningduty WHERE AppCleaningDutyID = ?");
        $stmt->bind_param("i", $appCleaningDutyID);
        if($stmt->execute()){
            return APPCLEAN_DELETED; 
        }else{
            return APPCLEAN_UNCHANGED;
        }
    }
    public function deleteapptemperature($appTemperatureID){
        $stmt = $this->connection->prepare("DELETE FROM apptemperature WHERE AppTemperatureID = ?");
        $stmt->bind_param("i", $appTemperatureID);
        if($stmt->execute()){
            return APPTEMP_DELETED; 
        }else{
            return APPTEMP_UNCHANGED;
        }
    }
    public function deleteriskapptemperature($riskAppTemperatureID){
        $stmt = $this->connection->prepare("DELETE FROM riskapptemperature WHERE RiskAppTemperatureID = ?");
        $stmt->bind_param("i", $riskAppTemperatureID);
        if($stmt->execute()){
            return RISKAPPTEMP_DELETED; 
        }else{
            return RISKAPPTEMP_UNCHANGED;
        }
    }
    public function deleteappcleaningdutyTIME(){
        $stmt = $this->connection->prepare("DELETE FROM appcleaningduty WHERE DATE(DutyDate) < DATE(NOW() - INTERVAL 3 YEAR)");
        if($stmt->execute()){
            return APPCLEANTIME_DELETED; 
        }else{
            return APPCLEANTIME_UNCHANGED;
        }
    }
    public function deleteapptemperatureTIME(){
        $stmt = $this->connection->prepare("DELETE FROM apptemperature WHERE DATE(TemperatureDate) < DATE(NOW() - INTERVAL 3 YEAR)");
        if($stmt->execute()){
            return APPTEMPTIME_DELETED; 
        }else{
            return APPTEMPTIME_UNCHANGED;
        }
    }
    public function deleteriskapptemperatureTIME(){
        $stmt = $this->connection->prepare("DELETE FROM riskapptemperature WHERE DATE(TemperatureDate) < DATE(NOW() - INTERVAL 3 YEAR)");
        if($stmt->execute()){
            return RISKAPPTEMPTIME_DELETED; 
        }else{
            return RISKAPPTEMPTIME_UNCHANGED;
        }
    }
   
    //DELETE METHODS COMPLETE
    //Other Methods
    //Function for checking EmployeeID Parameter in cleaning
    private function checkEmployeeinCleaning($employeeID){
        $stmt =$this->connection->prepare("SELECT EmployeeID FROM nonappcleaningduty WHERE EmployeeID = ?");
        $stmt->bind_param("i",  $employeeID); //Bind parameter to int
        $stmt->execute();
        $stmt->store_result();

        return $stmt->num_rows >0; 
    }
    //Function for checking EmployeeID Parameter in temperature
    private function checkEmployeeinTemp($employeeID){
        $stmt =$this->connection->prepare("SELECT EmployeeID FROM nonapptemperature WHERE EmployeeID = ?");
        $stmt->bind_param("i",  $employeeID); //Bind parameter to int
        $stmt->execute();
        $stmt->store_result();

        return $stmt->num_rows >0; 
    }
     //Function for checking EmployeeID Parameter in risktemperature
     private function checkEmployeeinRiskTemp($employeeID){
        $stmt =$this->connection->prepare("SELECT EmployeeID FROM risknonapptemperature WHERE EmployeeID = ?");
        $stmt->bind_param("i",  $employeeID); //Bind parameter to int
        $stmt->execute();
        $stmt->store_result();

        return $stmt->num_rows >0; 
    }
    //Function for checking ManagerID Parameter in cleaning
    private function checkManagerinCleaning($managerID){
        $stmt =$this->connection->prepare("SELECT ManagerID FROM appcleaningduty WHERE ManagerID = ?");
        $stmt->bind_param("i",  $managerID); //Bind parameter to int
        $stmt->execute();
        $stmt->store_result();
        return $stmt->num_rows >0; 
    }
    //Function for checking ManagerID Parameter in temperature
    private function checkManagerinTemp($managerID){
        $stmt =$this->connection->prepare("SELECT ManagerID FROM apptemperature WHERE ManagerID = ?");
        $stmt->bind_param("i",  $managerID); //Bind parameter to int
        $stmt->execute();
        $stmt->store_result();
        return $stmt->num_rows >0; 
    }
    //Function for checking ManagerID Parameter in risktemperature
    private function checkManagerinRiskTemp($managerID){
        $stmt =$this->connection->prepare("SELECT ManagerID FROM riskapptemperature WHERE ManagerID = ?");
        $stmt->bind_param("i",  $managerID); //Bind parameter to int
        $stmt->execute();
        $stmt->store_result();
        return $stmt->num_rows >0; 
    }
    //Function for checking EmployeeID Parameter in database
    private function checkEmployeeExists($employeeID){
        $stmt =$this->connection->prepare("SELECT EmployeeID FROM employee WHERE EmployeeID = ?");
        $stmt->bind_param("i",  $employeeID); //Bind parameter to int
        $stmt->execute();
        $stmt->store_result();

        return $stmt->num_rows >0; 
    }
    //Function for checking UnitID Parameter in database
    private function checkUnitIDExists($unitID){
        $stmt =$this->connection->prepare("SELECT UnitID FROM unit WHERE UnitID = ?");
        $stmt->bind_param("i",  $unitID); //Bind parameter to int
        $stmt->execute();
        $stmt->store_result();
        return $stmt->num_rows >0; 
    }
    //Function for checking ManagerID Parameter in database
    private function checkManagerIDExists($managerID){
        $stmt =$this->connection->prepare("SELECT ManagerID FROM manager WHERE ManagerID = ?");
        $stmt->bind_param("i",  $managerID); //Bind parameter to int
        $stmt->execute();
        $stmt->store_result();
        return $stmt->num_rows >0; 
    }

    //Function for checking EmployeeID Parameter in manager table
    private function checkManagerbyEmployeeIDExists($employeeID){
        $stmt =$this->connection->prepare("SELECT EmployeeID FROM manager WHERE EmployeeID = ?");
        $stmt->bind_param("i",  $employeeID); //Bind parameter to int
        $stmt->execute();
        $stmt->store_result();
        return $stmt->num_rows >0; 
    }
    //Function for getting password by EmployeeID
    private function getPasswordByEmployeeID($employeeID){
        $stmt =$this->connection->prepare("SELECT EmployeePassword FROM employee WHERE EmployeeID = ?");
        $stmt->bind_param("i", $employeeID); //Bind parameter to i
        $stmt->execute();
        $stmt->bind_result($employeePassword); //bind result to password parameter
        $stmt->fetch(); //Fetch Result
        return $employeePassword; //Return encrypted password
    }
     //Function for getting ManagerID by EmployeeID
     private function getManagerIDByEmployeeID($employeeID){
        $stmt =$this->connection->prepare("SELECT ManagerID FROM employee WHERE EmployeeID = ?");
        $stmt->bind_param("i", $employeeID); //Bind parameter to i
        $stmt->execute();
        $stmt->bind_result($managerID); //bind result to parameter
        $stmt->fetch(); //Fetch Result
        return $managerID; //Return managerID
    }

}
?>