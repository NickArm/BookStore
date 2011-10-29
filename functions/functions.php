<?php

public function ExecuteQuery($query){
        $result = mysql_query($query, $this->dblink) or die ("Query '$query' failed: ".mysql_error());
        
        return $result;
    }

    public function GetRecord($result){
        return mysql_fetch_array($result,MYSQL_ASSOC);
    }

    public function GetFieldNames($result){

        $tmp = $this->GetFieldNum($result);

        for($i=0;$i<$tmp;$i++){
            $FieldNames[]=mysql_field_name($result,$i);
        }

        return $FieldNames;
    }

    public function GetFieldNum($result){
        return mysql_num_fields($result);
    }

    public function GetRowNum($result){
        return mysql_num_rows($result);
    }

    public function GetLastInsertID(){
        return mysql_insert_id($this->dblink);
    }

    public function GetAffectedRows(){
        return my_sql_affected_rows($this->dblink);
    }

    public function PrintQueryTable($query){
        $result = $this->ExecuteQuery($query);

        echo "<table border='1'>";
        echo "<tr>";
        echo "<th>A/A</th>";

        $FieldNames = $this->GetFieldNames($result);
        foreach ($FieldNames as $tmp){
            echo "<th>$tmp</th>";
        }
        
        $i = 1;
        echo "</tr>";
               
        while($record = $this->GetRecord($result)){            
            echo "<tr>";
            echo "<td>$i</td>";            
            foreach ($record as $Field){
                echo "<td>$Field</td>";
            }
            
            echo "</tr>";
            $i++;
        }
        echo "</table>";
    }

    public function PrintQueryTableWithLink($query,$FieldLink,$Link,$LinkProperty){
        
        $result = $this->ExecuteQuery($query);

        echo "<table border='1'>";
        echo "<tr>";
        echo "<th>A/A</th>";

        $FieldNames = $this->GetFieldNames($result);
        foreach ($FieldNames as $tmp){
            echo "<th>$tmp</th>";
        }
        
        $i = 1;
        echo "</tr>";
               
        while($record = $this->GetRecord($result)){            
            echo "<tr>";
            echo "<td>$i</td>";            
            foreach ($record as $Field=>$value){
                if ($Field == $FieldLink){
                    if (isset($LinkProperty)){
                        echo "<td>".'<a href="'.$Link.'?'.$Field.'='.$LinkProperty.'">'.$value.'</a>'."</td>";
                    }else{
                        echo "<td>".'<a href="'.$Link.'?'.$Field.'='.$value.'">'.$value.'</a>'."</td>";
                    }
                }else{
                    echo "<td>$value</td>";
                }
            }
            
            echo "</tr>";
            $i++;
        }
        echo "</table>";
    }

    public function GetResultAsArray($result){

        if ($this->GetRowNum($result)==0){
            return false;
        }else{
            while($record = $this->GetRecord($result)){
                $data[]= $record;
            }
            return $data;
        }
    }

    public function GetQueryAsArray($query){
        $result = $this->ExecuteQuery($query);        
        return $this->GetResultAsArray($result);
    }

    public function GetUniqueRecordAsArray($query){
        
        $result = $this->ExecuteQuery($query);
        
        if ($this->GetRowNum($result)==1){
            $record = $this->GetRecord($result);
            return $record;
        }else{            
            return false;
        }        
    }
?>