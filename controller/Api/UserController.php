<?php
    class UserController extends BaseController{
        /**
         * "User read" Endpoint - GET list of users
         */
        public function readAction(){
            $strErrorDesc = "";
            $strErrorHeader = "";
            $requestMethod = $_SERVER["REQUEST_METHOD"];
            $arrQueryStringParams = $this->getQueryStringParams();
            $responseData = null;

            if(strtoupper($requestMethod) == "GET"){
                try{
                    $usermodel = new UserModel();
                    
                    $intLimit = 10;
                    // check if the $arrQueryStringParams limit is filled and has limit parameter then replace the limit
                    if(isset($arrQueryStringParams['limit']) && $arrQueryStringParams["limit"]){
                        $intLimit = $arrQueryStringParams["limit"];
                    }

                    $arrUsers = $usermodel->getUsers($intLimit);
                    $responseData = json_encode($arrUsers);
                }
                catch (Error $e){
                    $strErrorDesc = $e->getMessage()."Something Went Wrong! Please Contact Support";
                    $strErrorHeader = "HTTP/1.1 500 Internal Server Error";
                }
            }
            else{
                $strErrorDesc = "Method Not Supported";
                $strErrorHeader = "HTTP/1.1 422 Unprocessable Entity";
            }

            $this->outputResponse($responseData, $strErrorDesc, $strErrorHeader);
        }

        /**
         * "User Create" PUT create new users
         */
        public function createAction(){
            $strErrorDesc = "";
            $strErrorHeader = "";
            $requestMethod = $_SERVER["REQUEST_METHOD"];
            $arrQueryStringParams = $this->getQueryStringParams();
            $responseData = null;

            if(strtoupper($requestMethod) == "PUT"){
                try{
                    $usermodel = new UserModel();

                    $usernameExist = isset($arrQueryStringParams["username"]) && $arrQueryStringParams["username"];

                    $emailExist = isset($arrQueryStringParams["email"]) && $arrQueryStringParams["email"];

                    $statusValue = 0;

                    if($usernameExist && $emailExist){
                        if(isset($arrQueryStringParams["status"]) && $arrQueryStringParams["status"]){
                            $statusValue = 1;
                        }

                        $username = $arrQueryStringParams["username"];

                        $email = $arrQueryStringParams["email"];
                        
                        $createStatus = $usermodel->createUsers($username, $email, $statusValue);
                        $responseData = json_encode($createStatus);
                    }
                    else{
                        $strErrorDesc = "Username or Email Not filled";
                        $strErrorHeader = "HTTP/1.1 422 Unprocessable Entity";
                    }
                }
                catch (Exception $e){
                    $strErrorDesc = $e->getMessage()."Something Went Wrong! Please Contact Support";
                    $strErrorHeader = "HTTP/1.1 500 Internal Server Error";
                }
            }
            else{
                $strErrorDesc = "Method Not Supported";
                $strErrorHeader = "HTTP/1.1 422 Unprocessable Entity";
            }

            $this->outputResponse($responseData, $strErrorDesc, $strErrorHeader);
        }

        /**
         * "User Delete" DELETE a certain user data
         */
        public function deleteAction(){
            $strErrorDesc = "";
            $strErrorHeader = "";
            $requestMethod = $_SERVER["REQUEST_METHOD"];
            $arrQueryStringParams = $this->getQueryStringParams();
            $responseData = null;

            if(strtoupper($requestMethod) == "DELETE"){
                try{
                    $usermodel = new UserModel();

                    if(isset($arrQueryStringParams["id"]) && $arrQueryStringParams["id"]){
                        $deleteStatus = $usermodel->deleteUsers($arrQueryStringParams["id"]);
                        $responseData = json_encode($deleteStatus);
                    }
                    else{
                        $strErrorDesc = "Id Not filled";
                        $strErrorHeader = "HTTP/1.1 422 Unprocessable Entity";
                    }

                }
                catch(Exception $e){
                    $strErrorDesc = $e->getMessage()."Something Went Wrong! Please Contact Support";
                    $strErrorHeader = "HTTP/1.1 500 Internal Server Error";
                }
            }
            else{
                $strErrorDesc = "Method Not Supported";
                $strErrorHeader = "HTTP/1.1 422 Unprocessable Entity";
            }

            $this->outputResponse($responseData, $strErrorDesc, $strErrorHeader);
        }

        /**
         * "Update User" update user data
         */
        public function updateAction(){
            $strErrorDesc = "";
            $strErrorHeader = "";
            $requestMethod = $_SERVER["REQUEST_METHOD"];
            $arrQueryStringParams = $this->getQueryStringParams();
            $responseData = null;

            if(strtoupper($requestMethod) == "POST"){
                try{
                    $usermodel = new UserModel();

                    if(isset($arrQueryStringParams["id"]) && $arrQueryStringParams["id"]){
                        $usernameExist = isset($arrQueryStringParams["username"]) && $arrQueryStringParams["username"];

                        $emailExist = isset($arrQueryStringParams["email"]) && $arrQueryStringParams["email"];

                        $statusValue = 0;

                        if($usernameExist && $emailExist){
                            if(isset($arrQueryStringParams["status"]) && $arrQueryStringParams["status"]){
                                $statusValue = $arrQueryStringParams['status'];
                            }

                        $id = $arrQueryStringParams["id"];

                        $username = $arrQueryStringParams["username"];

                        $email = $arrQueryStringParams["email"];
                        
                        $updateStatus = $usermodel->updateUsers($id ,$username, $email, $statusValue);
                        $responseData = json_encode($updateStatus);
                        }
                        else{
                            $strErrorDesc = "Username or Email Not filled";
                            $strErrorHeader = "HTTP/1.1 422 Unprocessable Entity";
                        }
                    }
                    else{
                        $strErrorDesc = "Id Not filled";
                        $strErrorHeader = "HTTP/1.1 422 Unprocessable Entity";
                    }
                }
                catch(Exception $e){
                    $strErrorDesc = $e->getMessage()."Something Went Wrong! Please Contact Support";
                    $strErrorHeader = "HTTP/1.1 500 Internal Server Error";
                }
            }
            else{
                $strErrorDesc = "Method Not Supported";
                $strErrorHeader = "HTTP/1.1 422 Unprocessable Entity";
            }

            $this->outputResponse($responseData, $strErrorDesc, $strErrorHeader);
        }

        /**
         * Give Response of processed command
         */
        private function outputResponse($responseData = null, $strErrorDesc, $strErrorHeader){
            if(!$strErrorDesc){
                $this->successOutput($responseData, array("Content-Type: application/json", "HTTP/1.1 200 OK"));
            }
            else{
                $this->errorOutput($strErrorDesc, $strErrorHeader);
            }
        }

        /**
         * Success Output
         */
        private function successOutput($responseData, $httpHeader){
            $this->sendOutput(
                $responseData,
                $httpHeader
            );
        }

        /**
         * Error Output
         */
        private function errorOutput($strErrorDesc, $strErrorHeader){
            $this->sendOutput(json_encode(array("error" => $strErrorDesc)),
                    array("Content-Type: application/json", $strErrorHeader)
                );
        }
    }
?>