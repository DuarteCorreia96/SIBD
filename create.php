<?php
  function create_form($form_keys, $form_types, $form_action){

    echo("<form action ='$form_action' method='post'>");
    
    for($i = 0, $count = count($form_keys); $i <$count; $i++){

      if(strcmp($form_types[$i], 'year') == 0){

        echo("<div> <label for='$form_keys[$i]'>".str_replace('_',' ',$form_keys[$i]).": </label> 
          <input type='number' min='1950' max='2018' value='2015' id='$form_keys[$i]'  
          name ='$form_keys[$i]'/> </div>");

      } else {

        echo("<div> <label for='$form_keys[$i]'>".str_replace('_',' ',$form_keys[$i]).": </label> 
          <input type='$form_types[$i]' id='$form_keys[$i]'  name ='$form_keys[$i]'/> </div>");
      }
    }

    echo("<div class='button'> <input type='submit' value='Submit'/> </div></form>");
  }

#--------------------------------------------------------------------------------------------------
#--------------------------------------------------------------------------------------------------

  function create_tableh($headers, $stmt, $var_name = NULL, $href = NULL, $column = [0, 0], $button = array(NULL, NULL, 0, -1)){

    echo( "<table style='border: solid 1px black;'><tr>");
    foreach ($headers as $key) {
      echo("<th>$key</th>");
    }
    echo("</tr>");

    while($row = $stmt->fetch()){
      
      echo("<tr>");
      for($i = 0, $count = count($headers); $i < $count; $i++){

        if($i == $button[3] && $button != array(NULL, NULL, 0, -1)){
          
          $value = $row[$button[2]];
          echo("<td style='height:20px'>");
          echo("<form action ='$button[0]' method='post' style='margin-bottom: 0px'>");
          echo("<input type='hidden' id='$button[1]' name='$button[1]' value='$value'>");
          echo("<center><input type='submit' value='New'></center>");
          echo("</form>");
          echo("</td>"); 

        } elseif($i == $column[0] && $href != NULL && $var_name != NULL){

          $var_value = $row[$column[1]];
          $write = $row[$column[0]];
          echo("<td style='width:150px;border:1px solid black;'>");
          echo("<a href='$href?$var_name=$var_value'</a>$write");
          echo("</td>");

        } else {

          echo("<td style='width:150px;border:1px solid black;'>");
          echo("$row[$i]");
          echo("</td>");
        }
      }
      echo("</tr>");
    }  
    echo("</table>");
  }
?>