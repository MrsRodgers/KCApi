<?php
//SLIM FRAMEWORK API

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../connections/dbconnections.php';
require __DIR__ . '/../connections/dboperations.php';
$app = AppFactory::create();
$app->setBasePath("/KCApi/public");
$app->addErrorMiddleware(true, true, true);
$app->add(new Tuupola\Middleware\HttpBasicAuthentication([
    "users" => [
        "KCUser" => "KC1287037956795",
        
    ]
]));

/*
 * Endpoint: Create Employee
 * Parameters:EmployeeID, EmployeeName, EmployeePassword
 * Method:Post
 */
	$app->post('/createEmployee', function(Request $request, Response $response) { //Request and Response for Post Method
		if (!emptyParameters(array( 'EmployeeID', 'EmployeeName','EmployeePassword'), $response)) { //If there are no empty parameters
			$request_data = $request->getParsedBody(); //Get parsed values 
			//Define Parameters
			$employeeID = $request_data['EmployeeID'];
			$employeeName = $request_data['EmployeeName'];
			$employeePassword = $request_data['EmployeePassword'];
			
			//Encrypt password 
			$hash_password = password_hash($employeePassword, PASSWORD_DEFAULT);
			
			//Defined DBoperations 
			$dbO = new DbOperations;

			$result = $dbO->createEmployee($employeeID,$employeeName,$employeePassword); //define result variable

			if ($result == EMPLOYEE_CREATED) { //If created, no error and creation successful
				$message = array(); //Message array 
				$message['error'] = false; //No error
				$message['message'] = 'Employee Created Successfully.';

				$response->getBody()->write(json_encode($message)); //Write Response in Json Format

				return $response
									->withHeader('Content-type', 'application/json')
									->withStatus(201); //http status code 201 Created

			} else if ($result == EMPLOYEE_FAILURE) { //If failure, error message and creation not successful
				$message = array();
				$message['error'] = true; //Error 
				$message['message'] = 'An Error Occurred.'; 

				$response->getBody()->write(json_encode($message)); //Write response in Json Format

				return $response
									->withHeader('Content-type', 'application/json')
									->withStatus(422); //http status code 422 Unprocessable Entity

			} else if ($result == EMPLOYEE_EXISTS) { //if already exists, error message and no creation.
				$message = array();
				$message['error'] = true;
				$message['message'] = 'Employee Already Exists.';

				$response->getBody()->write(json_encode($message)); 

				return $response
									->withHeader('Content-type', 'application/json')
									->withStatus(422); //http status code 422 Unprocessable Entity
			}
		} 
		return $response //If empty parameters return error from emptyParameters method
							->withHeader('Content-type', 'application/json')
							->withStatus(422); //http status code 422 Unprocessable Entity
	});
/*
 * Endpoint: Create Manager
 * Parameters:ManagerID, EmployeeID, ManagerName
 * Method:Post
 */
	$app->post('/createManager', function(Request $request, Response $response) { //Request and Response for Post Method
		if (!emptyParameters(array( 'ManagerID', 'EmployeeID','ManagerName'), $response)) { //If there are no empty parameters
			$request_data = $request->getParsedBody(); //Get parsed values 
			//Define Parameters
			$managerID = $request_data['ManagerID'];
			$employeeID = $request_data['EmployeeID'];
			$managerName = $request_data['ManagerName'];
			
			//Defined DBoperations 
			$dbO = new DbOperations;

			$result = $dbO->createManager($managerID,$employeeID,$managerName); //define result variable

			if ($result == MANAGER_CREATED) { //If created, no error and creation successful
				$message = array(); //Message array 
				$message['error'] = false; //No error
				$message['message'] = 'Manager Created Successfully.';

				$response->getBody()->write(json_encode($message)); //Write Response in Json Format

				return $response
									->withHeader('Content-type', 'application/json')
									->withStatus(201); //http status code 201 Created

			} else if ($result == MANAGER_FAILURE) { //If failure, error message and creation not successful
				$message = array();
				$message['error'] = true; //Error 
				$message['message'] = 'An Error Occurred.'; 

				$response->getBody()->write(json_encode($message)); //Write response in Json Format

				return $response
									->withHeader('Content-type', 'application/json')
									->withStatus(422); //http status code 422 Unprocessable Entity

			} else if ($result == MANAGER_EXISTS) { //if already exists, error message and no creation.
				$message = array();
				$message['error'] = true;
				$message['message'] = 'Manager Already Exists.';

				$response->getBody()->write(json_encode($message)); 

				return $response
									->withHeader('Content-type', 'application/json')
									->withStatus(422); //http status code 422 Unprocessable Entity
			}else if ($result == EMPLOYEE_NOTEXIST) { //if does not exist, error message and no creation.
				$message = array();
				$message['error'] = true;
				$message['message'] = 'Employee Must Exist Before Manager Registration.';

				$response->getBody()->write(json_encode($message)); 

				return $response
									->withHeader('Content-type', 'application/json')
									->withStatus(422); //http status code 422 Unprocessable Entity
			}
		} 
		return $response //If empty parameters return error from emptyParameters method
							->withHeader('Content-type', 'application/json')
							->withStatus(422); //http status code 422 Unprocessable Entity
	});

/*
 * Endpoint: Create Unit
 * Parameters:UnitID, Location, UnitName, ManagerID
 * Method:Post
 */
	$app->post('/createUnit', function(Request $request, Response $response) { //Request and Response for Post Method
		if (!emptyParameters(array( 'UnitID', 'Location','UnitName', 'ManagerID'), $response)) { //If there are no empty parameters
			$request_data = $request->getParsedBody(); //Get parsed values 
			//Define Parameters
			$unitID = $request_data['UnitID'];
			$location = $request_data['Location'];
			$unitName = $request_data['UnitName'];
			$managerID = $request_data['ManagerID'];
			
			//Defined DBoperations 
			$dbO = new DbOperations;

			$result = $dbO->createUnit($unitID,$location,$unitName,$managerID); //define result variable

			if ($result == UNIT_CREATED) { //If created, no error and creation successful
				$message = array(); //Message array 
				$message['error'] = false; //No error
				$message['message'] = 'Unit Created Successfully.';

				$response->getBody()->write(json_encode($message)); //Write Response in Json Format

				return $response
									->withHeader('Content-type', 'application/json')
									->withStatus(201); //http status code 201 Created

			} else if ($result == UNIT_FAILURE) { //If failure, error message and creation not successful
				$message = array();
				$message['error'] = true; //Error 
				$message['message'] = 'An Error Occurred.'; 

				$response->getBody()->write(json_encode($message)); //Write response in Json Format

				return $response
									->withHeader('Content-type', 'application/json')
									->withStatus(422); //http status code 422 Unprocessable Entity

			} else if ($result == UNIT_EXISTS) { //if already exists, error message and no creation.
				$message = array();
				$message['error'] = true;
				$message['message'] = 'Unit Already Exists.';

				$response->getBody()->write(json_encode($message)); 

				return $response
									->withHeader('Content-type', 'application/json')
									->withStatus(422); //http status code 422 Unprocessable Entity
			}else if ($result == MANAGER_NOTEXIST) { //if does not exist, error message and no creation.
				$message = array();
				$message['error'] = true;
				$message['message'] = 'Manager Must Exist Before Unit Registration.';

				$response->getBody()->write(json_encode($message)); 

				return $response
									->withHeader('Content-type', 'application/json')
									->withStatus(422); //http status code 422 Unprocessable Entity
			}
		} 
		return $response //If empty parameters return error from emptyParameters method
							->withHeader('Content-type', 'application/json')
							->withStatus(422); //http status code 422 Unprocessable Entity
	});

/*
 * Endpoint: Create NonAppCleaningDuty
 * Parameters:CleaningDuty, DutyDate, EmployeeID, UnitID, CompletionStatus
 * Method:Post
 */
	$app->post('/createNonAppCleaningDuty', function(Request $request, Response $response) { //Request and Response for Post Method
		if (!emptyParameters(array( 'CleaningDuty', 'DutyDate','EmployeeID', 'UnitID','CompletionStatus'), $response)) { //If there are no empty parameters
			$request_data = $request->getParsedBody(); //Get parsed values 
			//Define Parameters
			$cleaningDuty = $request_data['CleaningDuty'];
			$dutyDate = $request_data['DutyDate'];
			$employeeID = $request_data['EmployeeID'];
			$unitID = $request_data['UnitID'];
			$completion = $request_data['CompletionStatus'];

			//Defined DBoperations 
			$dbO = new DbOperations;

			$result = $dbO->createnonAppCleaningDuty($cleaningDuty,$dutyDate,$employeeID,$unitID,$completion); //define result variable

			if ($result == NONAPPCLEANINGDUTY_CREATED) { //If created, no error and creation successful
				$message = array(); //Message array 
				$message['error'] = false; //No error
				$message['message'] = 'NCleaning Entry Created Successfully.';

				$response->getBody()->write(json_encode($message)); //Write Response in Json Format

				return $response
									->withHeader('Content-type', 'application/json')
									->withStatus(201); //http status code 201 Created

			} else if ($result == NONAPPCLEANINGDUTY_FAILURE) { //If failure, error message and creation not successful
				$message = array();
				$message['error'] = true; //Error 
				$message['message'] = 'An Error Occurred.'; 

				$response->getBody()->write(json_encode($message)); //Write response in Json Format

				return $response
									->withHeader('Content-type', 'application/json')
									->withStatus(422); //http status code 422 Unprocessable Entity

			}else if ($result == UNIT_NOTEXIST) { //if does not exist, error message and no creation.
				$message = array();
				$message['error'] = true;
				$message['message'] = 'Unit Must Exist Before Data Entry.';

				$response->getBody()->write(json_encode($message)); 

				return $response
									->withHeader('Content-type', 'application/json')
									->withStatus(422); //http status code 422 Unprocessable Entity
			}
		} 
		return $response //If empty parameters return error from emptyParameters method
							->withHeader('Content-type', 'application/json')
							->withStatus(422); //http status code 422 Unprocessable Entity
	});

/*
 * Endpoint: Create NonAppTemperature
 * Parameters:ItemName, ItemTemperature, TemperatureDate, TemperatueTime, UnitID, EmployeeID
 * Method:Post
 */
	$app->post('/createNonAppTemperature', function(Request $request, Response $response) { //Request and Response for Post Method
		if (!emptyParameters(array( 'ItemName', 'ItemTemperature','TemperatureDate', 'TemperatueTime', 'UnitID','EmployeeID'), $response)) { //If there are no empty parameters
			$request_data = $request->getParsedBody(); //Get parsed values 
			//Define Parameters
			$itemName = $request_data['ItemName'];
			$itemTemperature = $request_data['ItemTemperature'];
			$temperatureDate = $request_data['TemperatureDate'];
			$temperatureTime= $request_data['TemperatueTime'];
			$unitID = $request_data['UnitID'];
			$employeeID = $request_data['EmployeeID'];

			//Defined DBoperations 
			$dbO = new DbOperations;

			$result = $dbO->createnonAppTemperature($itemName,$itemTemperature,$temperatureDate,$temperatureTime,$unitID,$employeeID); //define result variable

			if ($result == NONAPPTEMPERATURE_CREATED) { //If created, no error and creation successful
				$message = array(); //Message array 
				$message['error'] = false; //No error
				$message['message'] = 'NAppTemperature Entry Created Successfully.';

				$response->getBody()->write(json_encode($message)); //Write Response in Json Format

				return $response
									->withHeader('Content-type', 'application/json')
									->withStatus(201); //http status code 201 Created

			} else if ($result == NONAPPTEMPERATURE_FAILURE) { //If failure, error message and creation not successful
				$message = array();
				$message['error'] = true; //Error 
				$message['message'] = 'An Error Occurred.'; 

				$response->getBody()->write(json_encode($message)); //Write response in Json Format

				return $response
									->withHeader('Content-type', 'application/json')
									->withStatus(422); //http status code 422 Unprocessable Entity

			}else if ($result == UNIT_NOTEXIST) { //if does not exist, error message and no creation.
				$message = array();
				$message['error'] = true;
				$message['message'] = 'Unit Must Exist Before Data Entry.';

				$response->getBody()->write(json_encode($message)); 

				return $response
									->withHeader('Content-type', 'application/json')
									->withStatus(422); //http status code 422 Unprocessable Entity
			}
		} 
		return $response //If empty parameters return error from emptyParameters method
							->withHeader('Content-type', 'application/json')
							->withStatus(422); //http status code 422 Unprocessable Entity
	});

/*
 * Endpoint: Create RiskNonAppTemperature
 * Parameters:ItemName, ItemTemperature, TemperatureDate, TemperatueTime, UnitID, EmployeeID
 * Method:Post
 */
	$app->post('/createRiskNonAppTemperature', function(Request $request, Response $response) { //Request and Response for Post Method
		if (!emptyParameters(array( 'ItemName', 'ItemTemperature','TemperatureDate', 'TemperatueTime', 'UnitID','EmployeeID'), $response)) { //If there are no empty parameters
			$request_data = $request->getParsedBody(); //Get parsed values 
			//Define Parameters
			$itemName = $request_data['ItemName'];
			$itemTemperature = $request_data['ItemTemperature'];
			$temperatureDate = $request_data['TemperatureDate'];
			$temperatureTime= $request_data['TemperatueTime'];
			$unitID = $request_data['UnitID'];
			$employeeID = $request_data['EmployeeID'];

			//Defined DBoperations 
			$dbO = new DbOperations;

			$result = $dbO->createriskNonAppTemperature($itemName,$itemTemperature,$temperatureDate,$temperatureTime,$unitID,$employeeID); //define result variable

			if ($result == RISKNONAPPTEMPERATURE_CREATED) { //If created, no error and creation successful
				$message = array(); //Message array 
				$message['error'] = false; //No error
				$message['message'] = 'Risk NAppTemperature Entry Created Successfully.';

				$response->getBody()->write(json_encode($message)); //Write Response in Json Format

				return $response
									->withHeader('Content-type', 'application/json')
									->withStatus(201); //http status code 201 Created

			} else if ($result == RISKNONAPPTEMPERATURE_FAILURE) { //If failure, error message and creation not successful
				$message = array();
				$message['error'] = true; //Error 
				$message['message'] = 'An Error Occurred.'; 

				$response->getBody()->write(json_encode($message)); //Write response in Json Format

				return $response
									->withHeader('Content-type', 'application/json')
									->withStatus(422); //http status code 422 Unprocessable Entity

			}else if ($result == UNIT_NOTEXIST) { //if does not exist, error message and no creation.
				$message = array();
				$message['error'] = true;
				$message['message'] = 'Unit Must Exist Before Data Entry.';

				$response->getBody()->write(json_encode($message)); 

				return $response
									->withHeader('Content-type', 'application/json')
									->withStatus(422); //http status code 422 Unprocessable Entity
			}
		} 
		return $response //If empty parameters return error from emptyParameters method
							->withHeader('Content-type', 'application/json')
							->withStatus(422); //http status code 422 Unprocessable Entity
	});

/*
* Endpoint: Create AppCleaningDuty
* Parameters:CleaningDuty, DutyDate, ManagerID, UnitID, CompletionStatus
* Method:Post
*/
$app->post('/createAppCleaningDuty', function(Request $request, Response $response) { //Request and Response for Post Method
	if (!emptyParameters(array( 'CleaningDuty', 'DutyDate','ManagerID', 'UnitID','CompletionStatus'), $response)) { //If there are no empty parameters
		$request_data = $request->getParsedBody(); //Get parsed values 
		//Define Parameters
		$cleaningDuty = $request_data['CleaningDuty'];
		$dutyDate = $request_data['DutyDate'];
		$managerID = $request_data['ManagerID'];
		$unitID = $request_data['UnitID'];
		$completion = $request_data['CompletionStatus'];

		//Defined DBoperations 
		$dbO = new DbOperations;

		$result = $dbO->createAppCleaningDuty($cleaningDuty,$dutyDate,$managerID,$unitID,$completion); //define result variable

		if ($result == APPCLEANINGDUTY_CREATED) { //If created, no error and creation successful
			$message = array(); //Message array 
			$message['error'] = false; //No error
			$message['message'] = 'Cleaning Entry Created Successfully.';

			$response->getBody()->write(json_encode($message)); //Write Response in Json Format

			return $response
								->withHeader('Content-type', 'application/json')
								->withStatus(201); //http status code 201 Created

		} else if ($result == APPCLEANINGDUTY_FAILURE) { //If failure, error message and creation not successful
			$message = array();
			$message['error'] = true; //Error 
			$message['message'] = 'An Error Occurred.'; 

			$response->getBody()->write(json_encode($message)); //Write response in Json Format

			return $response
								->withHeader('Content-type', 'application/json')
								->withStatus(422); //http status code 422 Unprocessable Entity

		}else if ($result == UNIT_NOTEXIST) { //if does not exist, error message and no creation.
			$message = array();
			$message['error'] = true;
			$message['message'] = 'Unit Must Exist Before Data Entry.';

			$response->getBody()->write(json_encode($message)); 

			return $response
								->withHeader('Content-type', 'application/json')
								->withStatus(422); //http status code 422 Unprocessable Entity
		}
	} 
	return $response //If empty parameters return error from emptyParameters method
						->withHeader('Content-type', 'application/json')
						->withStatus(422); //http status code 422 Unprocessable Entity
});

/*
* Endpoint: Create AppTemperature
* Parameters:ItemName, ItemTemperature, TemperatureDate, TemperatueTime, UnitID, ManagerID
* Method:Post
*/
	$app->post('/createAppTemperature', function(Request $request, Response $response) { //Request and Response for Post Method
	if (!emptyParameters(array( 'ItemName', 'ItemTemperature','TemperatureDate', 'TemperatueTime', 'UnitID','ManagerID'), $response)) { //If there are no empty parameters
		$request_data = $request->getParsedBody(); //Get parsed values 
		//Define Parameters
		$itemName = $request_data['ItemName'];
		$itemTemperature = $request_data['ItemTemperature'];
		$temperatureDate = $request_data['TemperatureDate'];
		$temperatureTime= $request_data['TemperatueTime'];
		$unitID = $request_data['UnitID'];
		$managerID = $request_data['ManagerID'];

		//Defined DBoperations 
		$dbO = new DbOperations;

		$result = $dbO->createAppTemperature($itemName,$itemTemperature,$temperatureDate,$temperatureTime,$unitID,$managerID); //define result variable

		if ($result == APPTEMPERATURE_CREATED) { //If created, no error and creation successful
			$message = array(); //Message array 
			$message['error'] = false; //No error
			$message['message'] = 'AppTemperature Entry Created Successfully.';

			$response->getBody()->write(json_encode($message)); //Write Response in Json Format

			return $response
								->withHeader('Content-type', 'application/json')
								->withStatus(201); //http status code 201 Created

		} else if ($result == APPTEMPERATURE_FAILURE) { //If failure, error message and creation not successful
			$message = array();
			$message['error'] = true; //Error 
			$message['message'] = 'An Error Occurred.'; 

			$response->getBody()->write(json_encode($message)); //Write response in Json Format

			return $response
								->withHeader('Content-type', 'application/json')
								->withStatus(422); //http status code 422 Unprocessable Entity

		}else if ($result == UNIT_NOTEXIST) { //if does not exist, error message and no creation.
			$message = array();
			$message['error'] = true;
			$message['message'] = 'Unit Must Exist Before Data Entry.';

			$response->getBody()->write(json_encode($message)); 

			return $response
								->withHeader('Content-type', 'application/json')
								->withStatus(422); //http status code 422 Unprocessable Entity
		}
	} 
	return $response //If empty parameters return error from emptyParameters method
						->withHeader('Content-type', 'application/json')
						->withStatus(422); //http status code 422 Unprocessable Entity
	});

/*
 * Endpoint: Create RiskAppTemperature
 * Parameters:ItemName, ItemTemperature, TemperatureDate, TemperatueTime, UnitID, ManagerID
 * Method:Post
 */
	$app->post('/createRiskAppTemperature', function(Request $request, Response $response) { //Request and Response for Post Method
		if (!emptyParameters(array( 'ItemName', 'ItemTemperature','TemperatureDate', 'TemperatueTime', 'UnitID','ManagerID'), $response)) { //If there are no empty parameters
			$request_data = $request->getParsedBody(); //Get parsed values 
			//Define Parameters
			$itemName = $request_data['ItemName'];
			$itemTemperature = $request_data['ItemTemperature'];
			$temperatureDate = $request_data['TemperatureDate'];
			$temperatureTime= $request_data['TemperatueTime'];
			$unitID = $request_data['UnitID'];
			$managerID = $request_data['ManagerID'];

			//Defined DBoperations 
			$dbO = new DbOperations;

			$result = $dbO->createriskAppTemperature($itemName,$itemTemperature,$temperatureDate,$temperatureTime,$unitID,$managerID); //define result variable

			if ($result == RISKAPPTEMPERATURE_CREATED) { //If created, no error and creation successful
				$message = array(); //Message array 
				$message['error'] = false; //No error
				$message['message'] = 'Risk AppTemperature Entry Created Successfully.';

				$response->getBody()->write(json_encode($message)); //Write Response in Json Format

				return $response
									->withHeader('Content-type', 'application/json')
									->withStatus(201); //http status code 201 Created

			} else if ($result == RISKAPPTEMPERATURE_FAILURE) { //If failure, error message and creation not successful
				$message = array();
				$message['error'] = true; //Error 
				$message['message'] = 'An Error Occurred.'; 

				$response->getBody()->write(json_encode($message)); //Write response in Json Format

				return $response
									->withHeader('Content-type', 'application/json')
									->withStatus(422); //http status code 422 Unprocessable Entity

			}else if ($result == UNIT_NOTEXIST) { //if does not exist, error message and no creation.
				$message = array();
				$message['error'] = true;
				$message['message'] = 'Unit Must Exist Before Data Entry.';

				$response->getBody()->write(json_encode($message)); 

				return $response
									->withHeader('Content-type', 'application/json')
									->withStatus(422); //http status code 422 Unprocessable Entity
			}
		} 
		return $response //If empty parameters return error from emptyParameters method
							->withHeader('Content-type', 'application/json')
							->withStatus(422); //http status code 422 Unprocessable Entity
		});

		/*
 * Endpoint: Verify User Login
 * Parameters:EmployeeID, EmployeePassword
 * Method:Post
 */
		$app->post('/employeePassVerify', function(Request $request, Response $response){
			if (!emptyParameters(array('EmployeeID', 'EmployeePassword'), $response)){
				$request_data = $request->getParsedBody(); //Get parsed values 
				//Define Parameters
				$employeeID = $request_data['EmployeeID'];
				$employeePassword = $request_data['EmployeePassword'];
				//Defined DBoperations 
				$dbO = new DbOperations;
				$result = $dbO->verifyPassword($employeeID,$employeePassword); //define result variable
				
				if($result == EMPLOYEE_ACCEPTED){
					$employee=$dbO->getEmployeebyID($employeeID);
					$message = array(); //Message array 
					$message['error'] = false; //No error
					$message['message'] = 'Login Successful';
					$response_data['employee']=$employee; 
					$response->getBody()->write(json_encode($message)); //Write response in Json Format
					return $response
										->withHeader('Content-type', 'application/json')
										->withStatus(201); //http status code 201 Successful
		
				}else if ($result == EMPLOYEE_NOT_FOUND){
					$message = array(); //Message array 
					$message['error'] = true; //No error
					$message['message'] = 'Employee Does Not Exist';
		
					$response->getBody()->write(json_encode($message)); //Write response in Json Format
					return $response
										->withHeader('Content-type', 'application/json')
										->withStatus(422); //http 422 Unprocessable Entity
		
		
				}else if ($result == EMPLOYEE_INVALID){
					$message = array(); //Message array 
					$message['error'] = true; //No error
					$message['message'] = 'Password Incorrect';
		
					$response->getBody()->write(json_encode($message)); //Write response in Json Format
					return $response
										->withHeader('Content-type', 'application/json')
										->withStatus(422); //http 422 Unprocessable Entity
				}
			}
			return $response //If empty parameters return error from emptyParameters method
			->withHeader('Content-type', 'application/json')
			->withStatus(422); //http status code 422 Unprocessable Entity
		
		});

	/* Endpoint: Verify Manager Status
 	* Parameters:EmployeeID, EmployeePassword
 	* Method:Post
 	*/
		$app->post('/managerVerify', function(Request $request, Response $response){
			if (!emptyParameters(array('EmployeeID'), $response)){
				$request_data = $request->getParsedBody(); //Get parsed values 
				//Define Parameters
				$employeeID = $request_data['EmployeeID'];
				//Defined DBoperations 
				$dbO = new DbOperations;
				$result = $dbO->verifyManager($employeeID); //define result variable
		
				if($result == MANAGER_VERIFIED){
					$message = array(); //Message array 
					$message['error'] = false; //No error
					$message['message'] = 'Manager Verified';
		
					$response->getBody()->write(json_encode($message)); //Write response in Json Format
					return $response
										->withHeader('Content-type', 'application/json')
										->withStatus(201); //http status code 201 Successful
		
				}else if ($result == EMPLOYEE_NOT_FOUND){
					$message = array(); //Message array 
					$message['error'] = true; //No error
					$message['message'] = 'Employee Does Not Exist';
		
					$response->getBody()->write(json_encode($message)); //Write response in Json Format
					return $response
										->withHeader('Content-type', 'application/json')
										->withStatus(422); //http 422 Unprocessable Entity
		
		
				}else if ($result == EMPLOYEE_VERIFIED){
					$message = array(); //Message array 
					$message['error'] = false; //No error
					$message['message'] = 'Employee Verified';
		
					$response->getBody()->write(json_encode($message)); //Write response in Json Format
					return $response
										->withHeader('Content-type', 'application/json')
										->withStatus(200); 
				}
			}
			return $response //If empty parameters return error from emptyParameters method
			->withHeader('Content-type', 'application/json')
			->withStatus(422); //http status code 422 Unprocessable Entity
		
		});
	/* Endpoint: Get all available units
 	* Parameters: UnitID, Location, UnitName, ManagerID
 	* Method:Get
 	*/
	 $app->get('/allUnits', function(Request $request, Response $response){
		
			$dbO= new DbOperations;
			$units = $dbO->getallUnits();
			$response_data=array();
		
			$response_data['error']=false;
			$response_data['units']=$units;
		
			$response->getBody()->write(json_encode($response_data)); //Write response in Json Format
					return $response
										->withHeader('Content-type', 'application/json')
										->withStatus(201);
		
	});
	/* Endpoint: Get all Non Approved Cleaning Duties by unitID
 	* Parameters: NonAppCleaningDutyID, CleaningDuty, DutyDate, EmployeeID, UnitID, CompletionStatus
 	* Method:Get
 	*/
	 $app->get('/allNonAppCleaningDuties', function(Request $request, Response $response){
		$dbO= new DbOperations;
		if (!emptyParameters(array('UnitID'), $response)){
			$nonappcleaningduties = $dbO->getallNonApprovedCleaningDutybyID($unitID);
			$response_data=array();
		
			$response_data['error']=false;
			$response_data['nonappcleaningduties']=$nonappcleaningduties;
		
			$response->getBody()->write(json_encode($response_data)); //Write response in Json Format
					return $response
										->withHeader('Content-type', 'application/json')
										->withStatus(201);

		}
		return $response //If empty parameters return error from emptyParameters method
			->withHeader('Content-type', 'application/json')
			->withStatus(422); //http status code 422 Unprocessable Entity
		
	});
	/* Endpoint: Get all Non Approved Temperatures by unitID
 	* Parameters: NonAppTemperatureID, ItemName, ItemTemperature, TemperatureDate, TemperatueTime, UnitID, EmployeeID
 	* Method:Get
 	*/
	 $app->get('/allNonAppTemperatures', function(Request $request, Response $response){
		$dbO= new DbOperations;
		if (!emptyParameters(array('UnitID'), $response)){
			$nonapptemperatures = $dbO->getallNonApprovedTempeaturesbyID($unitID);
			$response_data=array();
		
			$response_data['error']=false;
			$response_data['nonapptemperatures']=$nonapptemperatures;
		
			$response->getBody()->write(json_encode($response_data)); //Write response in Json Format
					return $response
										->withHeader('Content-type', 'application/json')
										->withStatus(201);

		}
		return $response //If empty parameters return error from emptyParameters method
			->withHeader('Content-type', 'application/json')
			->withStatus(422); //http status code 422 Unprocessable Entity
		
	});
	/* Endpoint: Get all Non Approved Risk Temperatures by unitID
 	* Parameters: RiskNonAppTemperatureID, ItemName, ItemTemperature, TemperatureDate, TemperatueTime, UnitID, EmployeeID
 	* Method:Get
 	*/
	 $app->get('/allRiskNonAppTemperatures', function(Request $request, Response $response){
		$dbO= new DbOperations;
		if (!emptyParameters(array('UnitID'), $response)){
			$users = $dbO->getallRiskNonApprovedTempeaturesbyID($unitID);
			$response_data=array();
		
			$response_data['error']=false;
			$response_data['risknonapptemperatures']=$risknonapptemperatures;
		
			$response->getBody()->write(json_encode($response_data)); //Write response in Json Format
					return $response
										->withHeader('Content-type', 'application/json')
										->withStatus(201);

		}
		return $response //If empty parameters return error from emptyParameters method
			->withHeader('Content-type', 'application/json')
			->withStatus(422); //http status code 422 Unprocessable Entity
		
	});
	/* Endpoint: Get all Approved Cleaning Duties by unitID
 	* Parameters:AppCleaningDutyID, CleaningDuty, DutyDate, EmployeeID, UnitID, CompletionStatus
 	* Method:Get
 	*/
	 $app->get('/allApprovedCleaningDuties', function(Request $request, Response $response){
		$dbO= new DbOperations;
		if (!emptyParameters(array('UnitID'), $response)){
			$users = $dbO->getallApprovedCleaningDutybyID($unitID);
			$response_data=array();
		
			$response_data['error']=false;
			$response_data['appcleaningduties']=$appcleaningduties;
		
			$response->getBody()->write(json_encode($response_data)); //Write response in Json Format
					return $response
										->withHeader('Content-type', 'application/json')
										->withStatus(201);

		}
		return $response //If empty parameters return error from emptyParameters method
			->withHeader('Content-type', 'application/json')
			->withStatus(422); //http status code 422 Unprocessable Entity
		
	});
	/* Endpoint: Get all Approved Temperatures by unitID
 	* Parameters: AppTemperatureID, ItemName, ItemTemperature, TemperatureDate, TemperatueTime, UnitID, EmployeeID
 	* Method:Get
 	*/
	 $app->get('/allApprovedTempeatures', function(Request $request, Response $response){
		$dbO= new DbOperations;
		if (!emptyParameters(array('UnitID'), $response)){
			$users = $dbO->getallApprovedTempeaturesbyID($unitID);
			$response_data=array();
		
			$response_data['error']=false;
			$response_data['apptemperatures']=$apptemperatures;
		
			$response->getBody()->write(json_encode($response_data)); //Write response in Json Format
					return $response
										->withHeader('Content-type', 'application/json')
										->withStatus(201);

		}
		return $response //If empty parameters return error from emptyParameters method
			->withHeader('Content-type', 'application/json')
			->withStatus(422); //http status code 422 Unprocessable Entity
		
	});
	/* Endpoint: Get all Approved Risk Temperatures by unitID
 	* Parameters: RiskAppTemperatureID, ItemName, ItemTemperature, TemperatureDate, TemperatueTime, UnitID, EmployeeID
 	* Method:Get
 	*/
	 $app->get('/allApprovedRiskTempeatures', function(Request $request, Response $response){
		$dbO= new DbOperations;
		if (!emptyParameters(array('UnitID'), $response)){
			$users = $dbO->getallRiskApprovedTempeaturesbyID($unitID);
			$response_data=array();
		
			$response_data['error']=false;
			$response_data['riskapptemperatures']=$riskapptemperatures;
		
			$response->getBody()->write(json_encode($response_data)); //Write response in Json Format
					return $response
										->withHeader('Content-type', 'application/json')
										->withStatus(201);

		}
		return $response //If empty parameters return error from emptyParameters method
			->withHeader('Content-type', 'application/json')
			->withStatus(422); //http status code 422 Unprocessable Entity
		
	});
/* Endpoint: Update EmployeeInfo(Including Password)
* Parameters: employeeID, employeeName, employeePassword
* Method:Post(Should be Put but parameters consistently show up empty)
*/
$app->post('/updateEmployee', function(Request $request, Response $response ){
	if(!emptyParameters(array('EmployeeID','EmployeeName','EmployeePassword'), $response)){

		$request_data=$request->getParsedBody();
		$employeeID = $request_data['EmployeeID'];
		$employeeName = $request_data['EmployeeName'];
		$employeePassword = $request_data['EmployeePassword'];
		//Encrypt password 
		$hash_password = password_hash($employeePassword, PASSWORD_DEFAULT);
		$dbO= new DbOperations;
		$result = $dbO->updateEmployeeInfoManagerView( $employeeID, $employeeName, $employeePassword);
		if($result == EMPLOYEE_UPDATED){
			$response_data = array(); 
			$response_data['error'] = false;
			$response_data['message'] = 'Employe Updated';
			$response->getBody()->write(json_encode($response_data)); //Write response in Json Format
			return $response->withHeader('Content-type', 'application/json')
							->withStatus(200);
		}else if($result == EMPLOYEE_NOTUPDATED){
			$response_data = array(); 
			$response_data['error'] = true;
			$response_data['message'] = 'An Error Ocuured';
			$response->getBody()->write(json_encode($response_data)); //Write response in Json Format
			return $response->withHeader('Content-type', 'application/json')
							->withStatus(422);
		}else if($result == EMPLOYEE_NOTEXIST){
			$response_data = array(); 
			$response_data['error'] = true;
			$response_data['message'] = 'Employee Does Not Exist';
			$response->getBody()->write(json_encode($response_data)); //Write response in Json Format
			return $response->withHeader('Content-type', 'application/json')
							->withStatus(422);
		}
	}
	return $response //If empty parameters return error from emptyParameters method
	->withHeader('Content-type', 'application/json')
	->withStatus(422); //http status code 422 Unprocessable Entity

});
/* Endpoint: Update Employee Password
* Parameters: employeeID, employeePassword, new password
* Method:Post(Should be Put but parameters consistently show up empty)
*/
$app->PUT('/updateEmployeePass', function(Request $request, Response $response ){
	if(!emptyParameters(array('EmployeeID','currentPassword','newPassword'), $response)){

		$request_data=$request->getParsedBody();
		$employeeID = $request_data['EmployeeID'];
		$currentPassword = $request_data['currentPassword'];
		$newPassword = $request_data['newPassword'];
		$dbO= new DbOperations;
		$result = $dbO->updatePassword($currentPassword, $newPassword, $employeeID);
		if($result == PASSWORD_UPDATED){
			$response_data = array(); 
			$response_data['error'] = false;
			$response_data['message'] = 'Password Updated';
			$response->getBody()->write(json_encode($response_data)); //Write response in Json Format
			return $response->withHeader('Content-type', 'application/json')
							->withStatus(200);
		}else if($result == PASSWORD_UNCHANGED){
			$response_data = array(); 
			$response_data['error'] = true;
			$response_data['message'] = 'An Error Ocuured';
			$response->getBody()->write(json_encode($response_data)); //Write response in Json Format
			return $response->withHeader('Content-type', 'application/json')
							->withStatus(422);
		}else if($result == PASSWORD_INVALID){
			$response_data = array(); 
			$response_data['error'] = true;
			$response_data['message'] = 'Current Password Invalid, please contact Manager if you have forgotten your password.';
			$response->getBody()->write(json_encode($response_data)); //Write response in Json Format
			return $response->withHeader('Content-type', 'application/json')
							->withStatus(422);
		}
	}
	return $response //If empty parameters return error from emptyParameters method
	->withHeader('Content-type', 'application/json')
	->withStatus(422); //http status code 422 Unprocessable Entity

});

/* Endpoint: Update Manager Information
* Parameters: managerID,managerName
* Method:Post(Should be Put but parameters consistently show up empty)
*/
$app->put('/updateManager', function(Request $request, Response $response ){
	if(!emptyParameters(array('ManagerID','ManagerName'), $response)){

		$request_data=$request->getParsedBody();
		$managerID = $request_data['ManagerID'];
		$managerName = $request_data['ManagerName'];
		$dbO= new DbOperations;
		$result = $dbO->updateManager($managerID,$managerName);
		if($result == MANAGER_UPDATED){
			$response_data = array(); 
			$response_data['error'] = false;
			$response_data['message'] = 'Manager Updated';
			$response->getBody()->write(json_encode($response_data)); //Write response in Json Format
			return $response->withHeader('Content-type', 'application/json')
							->withStatus(200);
		}else if($result == MANAGER_NOTUPDATED){
			$response_data = array(); 
			$response_data['error'] = true;
			$response_data['message'] = 'An Error Ocuured';
			$response->getBody()->write(json_encode($response_data)); //Write response in Json Format
			return $response->withHeader('Content-type', 'application/json')
							->withStatus(422);
		}else if($result == MANAGER_NOTEXIST){
			$response_data = array(); 
			$response_data['error'] = true;
			$response_data['message'] = 'Manager Does not exist';
			$response->getBody()->write(json_encode($response_data)); //Write response in Json Format
			return $response->withHeader('Content-type', 'application/json')
							->withStatus(422);
		}
	}
	return $response //If empty parameters return error from emptyParameters method
	->withHeader('Content-type', 'application/json')
	->withStatus(422); //http status code 422 Unprocessable Entity
});

/* Endpoint: Update Unit Information
* Parameters:$unitID,$location,$unitName,$managerID
* Method:Post(Should be Put but parameters consistently show up empty)
*/
$app->put('/updateUnit', function(Request $request, Response $response ){
	if(!emptyParameters(array('UnitID','Location','UnitName','ManagerID'), $response)){

		$request_data=$request->getParsedBody();
		$unitID = $request_data['UnitID'];
		$location = $request_data['Location'];
		$unitName = $request_data['UnitName'];
		$managerID = $request_data['ManagerID'];

		$dbO= new DbOperations;
		$result = $dbO->updateUnit( $unitID,$location,$unitName,$managerID);
		if($result == UNIT_UPDATED){
			$response_data = array(); 
			$response_data['error'] = false;
			$response_data['message'] = 'Unit Updated';
			$response->getBody()->write(json_encode($response_data)); //Write response in Json Format
			return $response->withHeader('Content-type', 'application/json')
							->withStatus(200);
		}else if($result == UNIT_NOTUPDATED){
			$response_data = array(); 
			$response_data['error'] = true;
			$response_data['message'] = 'An Error Ocuured';
			$response->getBody()->write(json_encode($response_data)); //Write response in Json Format
			return $response->withHeader('Content-type', 'application/json')
							->withStatus(422);
		}else if($result == MANAGER_NOTEXIST){
			$response_data = array(); 
			$response_data['error'] = true;
			$response_data['message'] = 'Manager Does not exist';
			$response->getBody()->write(json_encode($response_data)); //Write response in Json Format
			return $response->withHeader('Content-type', 'application/json')
							->withStatus(422);
		}else if($result == UNIT_NOTEXIST){
			$response_data = array(); 
			$response_data['error'] = true;
			$response_data['message'] = 'Unit Does not exist';
			$response->getBody()->write(json_encode($response_data)); //Write response in Json Format
			return $response->withHeader('Content-type', 'application/json')
							->withStatus(422);
		}
	}
	return $response //If empty parameters return error from emptyParameters method
	->withHeader('Content-type', 'application/json')
	->withStatus(422); //http status code 422 Unprocessable Entity
});

/* Endpoint: Delete Employee Information
* Parameters: EmployeeID
* Method:Post(Should be delete but parameters consistently show up empty)
*/
$app->delete('/deleteEmployee', function(Request $request, Response $response){
	if(!emptyParameters(array('EmployeeID'), $response)){
		$request_data = $request->getParsedBody(); 
		$employeeID= $request_data['EmployeeID'];
		$dbO = new DbOperations; 
	
		$result=$dbO->deleteEmployee($employeeID);
	
		if($result==EMPLOYEE_DELETED){
			$response_data = array(); 
			$response_data['error'] = false;
			$response_data['message'] = 'Employee Deleted';
			$response->getBody()->write(json_encode($response_data)); //Write response in Json Format
			return $response->withHeader('Content-type', 'application/json')
							->withStatus(200);    
		}else if($result == EMPLOYEE_UNCHANGED){
			$response_data = array(); 
			$response_data['error'] = true;
			$response_data['message'] = 'An Error Occurred';
			$response->getBody()->write(json_encode($response_data)); //Write response in Json Format
			return $response->withHeader('Content-type', 'application/json')
							->withStatus(422);
		}else if($result == EMPLOYEE_NEEDED){
			$response_data = array(); 
			$response_data['error'] = true;
			$response_data['message'] = 'Employee Inputs must be approved before Deletion.';
			$response->getBody()->write(json_encode($response_data)); //Write response in Json Format
			return $response->withHeader('Content-type', 'application/json')
							->withStatus(422);
		}else if($result == DELETE_MANAGER_FIRST){
			$response_data = array(); 
			$response_data['error'] = true;
			$response_data['message'] = 'Manager Priveledges must be removed before Deletion';
			$response->getBody()->write(json_encode($response_data)); //Write response in Json Format
			return $response->withHeader('Content-type', 'application/json')
							->withStatus(422);
		}
	} return $response //If empty parameters return error from emptyParameters method
		->withHeader('Content-type', 'application/json')
		->withStatus(422); //http status code 422 Unprocessable Entity

	});	
/* Endpoint: Delete Manager Information
* Parameters: ManagerID
* Method:Post(Should be delete but parameters consistently show up empty)
*/
$app->delete('/deleteManager', function(Request $request, Response $response){
	if(!emptyParameters(array('ManagerID'), $response)){
		$request_data = $request->getParsedBody(); 
		$managerID= $request_data['ManagerID'];
		$dbO = new DbOperations; 
	
		$result=$dbO->deleteManager($managerID);
	
		if($result==MANAGER_DELETED){
			$response_data = array(); 
			$response_data['error'] = false;
			$response_data['message'] = 'Manager Deleted';
			$response->getBody()->write(json_encode($response_data)); //Write response in Json Format
			return $response->withHeader('Content-type', 'application/json')
							->withStatus(200);    
		}else if($result == MANAGER_UNCHANGED){
			$response_data = array(); 
			$response_data['error'] = true;
			$response_data['message'] = 'An Error Occurred';
			$response->getBody()->write(json_encode($response_data)); //Write response in Json Format
			return $response->withHeader('Content-type', 'application/json')
							->withStatus(422);
		}else if($result == MANAGER_NEEDED){
			$response_data = array(); 
			$response_data['error'] = true;
			$response_data['message'] = 'Manager Data must be retained for Inputs(Up to 3 years)';
			$response->getBody()->write(json_encode($response_data)); //Write response in Json Format
			return $response->withHeader('Content-type', 'application/json')
							->withStatus(422);
		}
	} return $response //If empty parameters return error from emptyParameters method
		->withHeader('Content-type', 'application/json')
		->withStatus(422); //http status code 422 Unprocessable Entity

	});	
/* Endpoint: Delete NonAppClean Information
* Parameters: UnitID
* Method:Post(Should be delete but parameters consistently show up empty)
*/
$app->post('/deletenonappcleaningduty', function(Request $request, Response $response){
	if(!emptyParameters(array('NonAppCleaningDutyID'), $response)){
		$request_data = $request->getParsedBody(); 
		$nonAppCleaningDutyID= $request_data['NonAppCleaningDutyID'];
		$dbO = new DbOperations; 
	
		$result=$dbO->deletenonappcleaningduty($nonAppCleaningDutyID);
	
		if($result==NONAPPCLEAN_DELETED){
			$response_data = array(); 
			$response_data['error'] = false;
			$response_data['message'] = 'NonAppClean Deleted';
			$response->getBody()->write(json_encode($response_data)); //Write response in Json Format
			return $response->withHeader('Content-type', 'application/json')
							->withStatus(200);    
		}else if($result == NONAPPCLEAN_UNCHANGED){
			$response_data = array(); 
			$response_data['error'] = true;
			$response_data['message'] = 'An Error Occurred';
			$response->getBody()->write(json_encode($response_data)); //Write response in Json Format
			return $response->withHeader('Content-type', 'application/json')
							->withStatus(422);
		}
	} return $response //If empty parameters return error from emptyParameters method
		->withHeader('Content-type', 'application/json')
		->withStatus(422); //http status code 422 Unprocessable Entity

	});	
/* Endpoint: Delete NonAppTemp Information
* Parameters: UnitID
* Method:Post(Should be delete but parameters consistently show up empty)
*/
$app->post('/deletenonapptemperature', function(Request $request, Response $response){
	if(!emptyParameters(array('NonAppTemperatureID'), $response)){
		$request_data = $request->getParsedBody(); 
		$nonAppTemperatureID= $request_data['NonAppTemperatureID'];
		$dbO = new DbOperations; 
	
		$result=$dbO->deletenonapptemperature($nonAppTemperatureID);
	
		if($result==NONAPPTEMP_DELETED){
			$response_data = array(); 
			$response_data['error'] = false;
			$response_data['message'] = 'NonAppTemp Deleted';
			$response->getBody()->write(json_encode($response_data)); //Write response in Json Format
			return $response->withHeader('Content-type', 'application/json')
							->withStatus(200);    
		}else if($result == ONAPPTEMP_UNCHANGED){
			$response_data = array(); 
			$response_data['error'] = true;
			$response_data['message'] = 'An Error Occurred';
			$response->getBody()->write(json_encode($response_data)); //Write response in Json Format
			return $response->withHeader('Content-type', 'application/json')
							->withStatus(422);
		}
	} return $response //If empty parameters return error from emptyParameters method
		->withHeader('Content-type', 'application/json')
		->withStatus(422); //http status code 422 Unprocessable Entity

	});	
/* Endpoint: Delete RiskNonAppTemp Information
* Parameters: UnitID
* Method:Post(Should be delete but parameters consistently show up empty)
*/
$app->post('/deleterisknonapptemperature', function(Request $request, Response $response){
	if(!emptyParameters(array('RiskNonAppTemperatureID'), $response)){
		$request_data = $request->getParsedBody(); 
		$riskNonAppTemperatureID= $request_data['RiskNonAppTemperatureID'];
		$dbO = new DbOperations; 
	
		$result=$dbO->deleterisknonapptemperature($riskNonAppTemperatureID);
	
		if($result==RISKNONAPPTEMP_DELETED){
			$response_data = array(); 
			$response_data['error'] = false;
			$response_data['message'] = 'RiskNonAppTemp Deleted';
			$response->getBody()->write(json_encode($response_data)); //Write response in Json Format
			return $response->withHeader('Content-type', 'application/json')
							->withStatus(200);    
		}else if($result == RISKNONAPPTEMP_UNCHANGED){
			$response_data = array(); 
			$response_data['error'] = true;
			$response_data['message'] = 'An Error Occurred';
			$response->getBody()->write(json_encode($response_data)); //Write response in Json Format
			return $response->withHeader('Content-type', 'application/json')
							->withStatus(422);
		}
	} return $response //If empty parameters return error from emptyParameters method
		->withHeader('Content-type', 'application/json')
		->withStatus(422); //http status code 422 Unprocessable Entity

	});	
/* Endpoint: Delete AppClean Information
* Parameters: UnitID
* Method:Post(Should be delete but parameters consistently show up empty)
*/
$app->post('/deleteappcleaningduty', function(Request $request, Response $response){
	if(!emptyParameters(array('AppCleaningDutyID'), $response)){
		$request_data = $request->getParsedBody(); 
		$appCleaningDutyID= $request_data['AppCleaningDutyID'];
		$dbO = new DbOperations; 
	
		$result=$dbO->deleteappcleaningduty($appCleaningDutyID);
	
		if($result==APPCLEAN_DELETED){
			$response_data = array(); 
			$response_data['error'] = false;
			$response_data['message'] = 'AppClean Deleted';
			$response->getBody()->write(json_encode($response_data)); //Write response in Json Format
			return $response->withHeader('Content-type', 'application/json')
							->withStatus(200);    
		}else if($result == APPCLEAN_UNCHANGED){
			$response_data = array(); 
			$response_data['error'] = true;
			$response_data['message'] = 'An Error Occurred';
			$response->getBody()->write(json_encode($response_data)); //Write response in Json Format
			return $response->withHeader('Content-type', 'application/json')
							->withStatus(422);
		}
	} return $response //If empty parameters return error from emptyParameters method
		->withHeader('Content-type', 'application/json')
		->withStatus(422); //http status code 422 Unprocessable Entity

	});	
/* Endpoint: Delete AppTemp Information
* Parameters: UnitID
* Method:Post(Should be delete but parameters consistently show up empty)
*/
$app->post('/deleteapptemperature', function(Request $request, Response $response){
	if(!emptyParameters(array('AppTemperatureID'), $response)){
		$request_data = $request->getParsedBody(); 
		$appTemperatureID= $request_data['AppTemperatureID'];
		$dbO = new DbOperations; 
	
		$result=$dbO->deleteapptemperature($appTemperatureID);
	
		if($result==APPTEMP_DELETED){
			$response_data = array(); 
			$response_data['error'] = false;
			$response_data['message'] = 'AppTemp Deleted';
			$response->getBody()->write(json_encode($response_data)); //Write response in Json Format
			return $response->withHeader('Content-type', 'application/json')
							->withStatus(200);    
		}else if($result ==APPTEMP_UNCHANGED){
			$response_data = array(); 
			$response_data['error'] = true;
			$response_data['message'] = 'An Error Occurred';
			$response->getBody()->write(json_encode($response_data)); //Write response in Json Format
			return $response->withHeader('Content-type', 'application/json')
							->withStatus(422);
		}
	} return $response //If empty parameters return error from emptyParameters method
		->withHeader('Content-type', 'application/json')
		->withStatus(422); //http status code 422 Unprocessable Entity

	});	
/* Endpoint: Delete RiskAppTemp Information
* Parameters: UnitID
* Method:Post(Should be delete but parameters consistently show up empty)
*/
$app->post('/deleteriskapptemperature', function(Request $request, Response $response){
	if(!emptyParameters(array('RiskAppTemperatureID'), $response)){
		$request_data = $request->getParsedBody(); 
		$riskAppTemperatureID= $request_data['RiskAppTemperatureID'];
		$dbO = new DbOperations; 
	
		$result=$dbO->deleteriskapptemperature($riskAppTemperatureID);
	
		if($result==RISKAPPTEMP_DELETED){
			$response_data = array(); 
			$response_data['error'] = false;
			$response_data['message'] = 'RiskAppTemp Deleted';
			$response->getBody()->write(json_encode($response_data)); //Write response in Json Format
			return $response->withHeader('Content-type', 'application/json')
							->withStatus(200);    
		}else if($result ==RISKAPPTEMP_UNCHANGED){
			$response_data = array(); 
			$response_data['error'] = true;
			$response_data['message'] = 'An Error Occurred';
			$response->getBody()->write(json_encode($response_data)); //Write response in Json Format
			return $response->withHeader('Content-type', 'application/json')
							->withStatus(422);
		}
	} return $response //If empty parameters return error from emptyParameters method
		->withHeader('Content-type', 'application/json')
		->withStatus(422); //http status code 422 Unprocessable Entity

	});	

/* Endpoint: Delete AppClean Information DATE
* Parameters: None
* Method:Post(Should be delete but parameters consistently show up empty)
*/
$app->post('/deleteappcleaningdutyTIME', function(Request $request, Response $response){
		$dbO = new DbOperations; 
	
		$result=$dbO->deleteappcleaningdutyTIME();
	
		if($result==APPCLEANTIME_DELETED){
			$response_data = array(); 
			$response_data['error'] = false;
			$response_data['message'] = 'AppClean Deleted Based on 3 year interval';
			$response->getBody()->write(json_encode($response_data)); //Write response in Json Format
			return $response->withHeader('Content-type', 'application/json')
							->withStatus(200);    
		}else if($result ==APPCLEANTIME_UNCHANGED){
			$response_data = array(); 
			$response_data['error'] = true;
			$response_data['message'] = 'An Error Occurred';
			$response->getBody()->write(json_encode($response_data)); //Write response in Json Format
			return $response->withHeader('Content-type', 'application/json')
							->withStatus(422);
		}
	});
/* Endpoint: Delete AppTemp Information DATE
* Parameters: None
* Method:Post(Should be delete but parameters consistently show up empty)
*/
$app->post('/deleteapptemperatureTIME', function(Request $request, Response $response){
	$dbO = new DbOperations; 

	$result=$dbO->deleteapptemperatureTIME();

	if($result==APPTEMPTIME_DELETED){
		$response_data = array(); 
		$response_data['error'] = false;
		$response_data['message'] = 'AppTemp Deleted Based on 3 year interval';
		$response->getBody()->write(json_encode($response_data)); //Write response in Json Format
		return $response->withHeader('Content-type', 'application/json')
						->withStatus(200);    
	}else if($result ==APPTEMPTIME_UNCHANGED){
		$response_data = array(); 
		$response_data['error'] = true;
		$response_data['message'] = 'An Error Occurred';
		$response->getBody()->write(json_encode($response_data)); //Write response in Json Format
		return $response->withHeader('Content-type', 'application/json')
						->withStatus(422);
	}
});
/* Endpoint: Delete RiskAppTemp Information DATE
* Parameters: None
* Method:Post(Should be delete but parameters consistently show up empty)
*/
$app->post('/deleteriskapptemperatureTIME', function(Request $request, Response $response){
	$dbO = new DbOperations; 

	$result=$dbO->deleteriskapptemperatureTIME();

	if($result==RISKAPPTEMPTIME_DELETED){
		$response_data = array(); 
		$response_data['error'] = false;
		$response_data['message'] = 'RiskAppTemp Deleted Based on 3 year interval';
		$response->getBody()->write(json_encode($response_data)); //Write response in Json Format
		return $response->withHeader('Content-type', 'application/json')
						->withStatus(200);    
	}else if($result ==RISKAPPTEMPTIME_UNCHANGED){
		$response_data = array(); 
		$response_data['error'] = true;
		$response_data['message'] = 'An Error Occurred';
		$response->getBody()->write(json_encode($response_data)); //Write response in Json Format
		return $response->withHeader('Content-type', 'application/json')
						->withStatus(422);
	}
});
  //Method for parameter validation
	function emptyParameters($required_params, $response) {
		$error = false; //Assume error is false to begin
		$error_params = ''; //Define empty parameter
		$request_params = $_REQUEST; //Define request parameters

		foreach ($required_params as $param) { //loop through parameters
			if(!isset($request_params[$param]) || strlen($request_params[$param]) <= 0) { //if the parameters are not set or the string length <0
				$error = true; //set error to true
				$error_params .= $param . ', '; //Define error parameters
			}
		}

		if($error) { //if there is an error show detail message
			$error_detail = array(); //Create error detail array
			$error_detail['error'] = true; 
			$error_detail['message'] = 'Required parameters ' . substr($error_params, 0, -2) . ' are missing or empty'; //remove last ', ' for error message

			$response->getBody()->write(json_encode($error_detail)); //json encode to return error message
		}

		return $error;
	}

$app->run();
?>