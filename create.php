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

  function create_tableh($headers, $stmt, $var_name = NULL, $href = NULL){

    echo( "<table style='border: solid 1px black;'><tr>");
    foreach ($headers as $key) {
      echo("<th>$key</th>");
    }

    echo("</tr>\n");
    while($row = $stmt->fetch()){
      
      echo("<tr>");
      for($i = 0, $count = count($row); $i < $count; $i++){

        if($i == 0 && $href != NULL && $var_name != NULL) {
          echo("<td style='width:150px;border:1px solid black;'>
            <a href='$href?$var_name=$row[0]'</a>$row[0]</td>"); 
        } else {
          echo("<td style='width:150px;border:1px solid black;'>".$row[$i]."</td>");
        }
      }
      echo("</tr>\n");
    }  
    echo("</table>");
  }
?>