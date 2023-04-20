<?php
    class ChatMessage{
        private $chat_message_id;
        private $to_user_id;
        private $from_user_id;
        private $chat_message;
        private $timestamp;
        private $status;

        protected function DefineTableName() {
            return("chat_message");
        }

        protected function DefineRelationMap() {
            return(array(
                    "chat_message_id" => "chat_message_id",
                    "to_user_id" => "to_user_id",
                    "from_user_id" => "from_user_id",
                    "chat_message" => "chat_message",
                    "timestamp" => "timestamp",
                    "status" => "status"
            ));
        }
        
        function contarmensajes($from_user_id, $to_user_id, $connect)
        {
            $query = "
            SELECT * FROM chat_message 
            WHERE from_user_id = '$from_user_id' 
            AND to_user_id = '$to_user_id' 
            AND status = '1'
            ";
            $statement = $connect->prepare($query);
            $statement->execute();
            $count = $statement->rowCount();
            return $count;
        }

        function fetch_group_historial($connect)
        {
            $query = "
            SELECT * FROM chat_message 
            WHERE to_user_id = '0'  
            ORDER BY timestamp DESC
            ";
            $statement = $connect->prepare($query);
            $statement->execute();
            $result = $statement->fetchAll();
            return $result;
        }
        
        function fetch_user_chatUsuario($from_user_id, $to_user_id, $connect)
        {
            $query = "
            SELECT * FROM chat_message 
            WHERE (from_user_id = '".$from_user_id."' 
            AND to_user_id = '".$to_user_id."') 
            OR (from_user_id = '".$to_user_id."' 
            AND to_user_id = '".$from_user_id."') 
            ORDER BY timestamp DESC
            ";
            $statement = $connect->prepare($query);
            $statement->execute();
            $result = $statement->fetchAll();
            return $result;
        }

    }
?>