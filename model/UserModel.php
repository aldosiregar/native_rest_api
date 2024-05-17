<?php
    require_once PROJECT_ROOT_PATH. "/model/Database.php";

    class UserModel extends Database{
        public function getUsers($limit){
            return $this->Select("SELECT * FROM users ORDER BY user_id ASC LIMIT ?", ["i", [$limit]]);
        }

        public function createUsers($username, $email, $status){
            return $this->Create("INSERT INTO users (username, user_email, user_status) VALUES (?, ?, ?)", ["ssi", [$username, $email, $status]]);
        }

        public function updateUsers($id, $username, $email, $status){
            if($this->checkUsers($id)){
                $this->Update("UPDATE users SET username = ?, user_email = ?, user_status = ? WHERE user_id = ?", ["ssii", [$username, $email, $status, $id]]);
            
                return "Data Is Successfully Updated";
            }
            else{
                return "Data not added yet"; 
            }
        }

        public function deleteUsers($id){
            if($this->checkUsers($id)){
                $this->Delete("DELETE FROM users WHERE user_id = ?", ["i", [$id]]);

                return "Data Is Succesfully Deleted";
            }
            else{
                return "Data Is missing";
            }
        }

        private function checkUsers($id){
            return $this->Check("SELECT * FROM users WHERE user_id = ?", ["i", [$id]]);
        }
    }
?>