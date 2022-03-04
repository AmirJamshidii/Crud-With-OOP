<?php 

    
    require_once('./config/dbconfig.php');
    $db = new Dbconfig();

    class Operations extends Dbconfig{
        // insert record in the database
        public function Store_Record(){
            global $db;
            if(isset($_POST['btn_save'])){
                $FirstName = $db->check($_POST['First']);
                $LastName = $db->check($_POST['Last']);
                $UserName = $db->check($_POST['UserName']);
                $UserEmail = $db->check($_POST['UserEmail']);

                if($this -> insert_record($FirstName,$LastName,$UserName,$UserEmail)){
                    echo '<div class="alert alert-success"> Your Record Has Been Saved :) </div>';
                }
                else{
                    echo '<div class="alert alert-danger"> Failed </div>';
                }
            }
        }


      // insert record in the database using query    
        function insert_record($a,$b,$c,$d)
        {
            global $db;
            $query = "insert into employees (FirstName,LastName, UserName,Email) values('$a','$b','$c','$d')";
            $result = mysqli_query($db -> connection,$query);

            if($result){
                return true;
            }
            else{
                return false;
            }
        }

       // view database record
        public function view_record(){
            global $db;
            $query = "select * from employees";
            $result = mysqli_query($db->connection,$query);
            return $result;
        }


        // get particular record
        public function get_record($id){
            global $db;
            $sql = "select * from employees where ID='$id'";
            $data = mysqli_query($db->connection,$sql);
            return $data;

        }



// update record
        public function update(){
            global $db;

            if(isset($_POST['btn_update'])){
                $ID = $_POST['ID'];
                $FirstName = $db -> check($_POST['First']);
                $LastName = $db -> check($_POST['Last']);
                $UserName = $db -> check($_POST['UserName']);
                $Email = $db -> check($_POST['UserEmail']);

                if($this -> update_record($ID,$FirstName,$LastName,$UserName,$Email )){
                    $this -> set_messsage('<div class="alert alert-success"> Your Record Has Been Updated : )</div>');
                    header("location:view.php");
                }else{   
                    $this -> set_messsage('<div class="alert alert-success"> Something Wrong : )</div>');
                } 
            } 
        }
       

 // update function 2
        public function update_record($id,$first,$Last,$User,$Email)
        {
            global $db;
            $sql = "update employees set FirstName='$first', LastName='$Last', UserName='$User', Email='$Email' where ID='$id'";
            $result = mysqli_query($db -> connection,$sql);
            if($result){
                return true;
            }
            else{
                return false;
            }
        }

        // set session message
        public function set_messsage($msg){
            if(!empty($msg)){
                $_SESSION['Message']=$msg;
            }
            else{
                $msg = "";
            }
        }

        // display session message
        public function display_message(){
            if(isset($_SESSION['Message'])){
                echo $_SESSION['Message'];
                unset($_SESSION['Message']);
            }
        }

        //delete record
        public function delete_record($id){
            global $db;
            $query = "DELETE FROM employees WHERE ID='$id'";
            $result = mysqli_query($db -> connection, $query);
            if($result){
                return true;
            }else{
                return false;
            }
        }
    }

    ?>