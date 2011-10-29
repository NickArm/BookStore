<?php function readGetVarField(){
        if (isset($_GET['field']) && (!empty($_GET['field']))){
            switch ($_GET['field']){
                case "offer":
                case "availiable":
                case "bestseller":
                    return $_GET['field'];
                    break;
                default:
                    return false;
                    break;
            }
        }else{
            return false;
        }
    }
	
	
	
	
	
	?>