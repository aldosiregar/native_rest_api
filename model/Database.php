<?php
    class Database{
        protected $connection = NULL;

        public function __construct()
        {
            try{
                $this->connection = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE_NAME);

                if(mysqli_connect_errno()){
                    throw new Exception("could not connect to database");
                }
            }
            catch(Exception $e){
                throw new Exception($e->getMessage()); 
            }
        }

        public function Select($query = "", $params = []){
            try{
                $stmt = $this->executeStatementRead($query, $params);
                $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
                $stmt->close();

                return $result;
            }
            catch(Exception $e){
                throw new Exception($e->getMessage());
            }
            return false;
        }

        public function Create($query = "", $params = []){
            try{
                $stmt = $this->executeStatementCreate($query, $params);
                $stmt->close();

                return "Data is Succesfully Added";
            }
            catch(Exception $e) {
                throw new Exception($e->getMessage());
            }
        }

        public function Check($query = "", $params = []){
            $exist = false;
            try{
                $stmt = $this->executeStatementCheck($query, $params);
                $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
                $stmt->close();
                
                if($result){
                    return true;
                }
                else{
                    return false;
                }
            }
            catch(Exception $e){
                throw new Exception($e->getMessage());
            }
        }

        public function Delete($query = "", $params = []){
            try{
                $stmt = $this->executeStatementDelete($query, $params);
                $stmt->close();
            }
            catch(Exception $e){
                throw new Exception($e->getMessage());
            }
        }

        public function Update($query = "", $params = []){
            try{
                $stmt = $this->executeStatementUpdate($query, $params);
                $stmt->close();
            }
            catch(Exception $e){
                throw new Exception($e->getMessage());
            }
        }

        private function executeStatementRead($query = "", $params = []){
            try{
                $stmt = $this->connection->prepare($query);
                if($stmt === false){
                    throw new Exception("Unable to prepared statement: ". $query);
                }

                if($params){
                    $stmt->bind_param($params[0], $params[1][0]);
                }

                $stmt->execute();

                return $stmt;
            }
            catch(Exception $e){
                throw new Exception($e->getMessage());
            }
        }

        private function executeStatementCheck($query, $params = []){
            try{
                $stmt = $this->connection->prepare($query);
                if($stmt === false){
                    throw new Exception("Unable to prepared statement: ". $query);
                }

                if($params){
                    $stmt->bind_param($params[0], $params[1][0]);
                }

                $stmt->execute();

                return $stmt;
            }
            catch(Exception $e){
                throw new Exception($e->getMessage());
            }
        }

        private function executeStatementCreate($query = "", $params = []){
            try{
                $stmt = $this->connection->prepare($query);
                if($stmt === false){
                    throw new Exception("Unable to prepared statement: ". $query);
                }

                if($params){
                    $stmt->bind_param($params[0], $params[1][0], $params[1][1], $params[1][2]);
                }

                $stmt->execute();

                return $stmt;
            }
            catch(Exception $e){
                throw new Exception($e->getMessage());
            }
        }

        private function executeStatementDelete($query = "", $params = []){
            try{
                $stmt = $this->connection->prepare($query);
                if($stmt === false){
                    throw new Exception("Unable to prepared statement: ". $query);
                }

                if($params){
                    $stmt->bind_param($params[0], $params[1][0]);
                }

                $stmt->execute();

                return $stmt;
            }
            catch(Exception $e){
                throw new Exception($e->getMessage());
            }
        }

        private function executeStatementUpdate($query = "", $params = []){
            try{
                $stmt = $this->connection->prepare($query);
                if($stmt === false){
                    throw new Exception("Unable to prepared statement: ". $query);
                }

                if($params){
                    $stmt->bind_param($params[0], $params[1][0], $params[1][1], $params[1][2], $params[1][3]);
                }

                $stmt->execute();

                return $stmt;
            }
            catch(Exception $e){
                throw new Exception($e->getMessage());
            }
        }
    }
?>