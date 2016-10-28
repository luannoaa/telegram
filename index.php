<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>1-Aula de php</title>
     
    </head>
    <body>
        <?php
       // date_default_timezone_set('Australia/Darwin');
        
        
        $offsetUTC = date('Z');
       
        
       
        ini_set('max_execution_time', 300);
        function corrigeUTC($timestamp, $offset){
             $offsetClean = (int)preg_replace('/[^0-9]/','',$offset);
             if(preg_match('/^-.*/', $offset) == 1){
                return $timestamp - $offsetClean;
            } else {
                return $timestamp + $offsetClean;
            }
        }
              
        function sendMessage($id,$texto){
                $url1 = 'https://api.telegram.org/bot243968836:AAEVbfB8V6hgSqFa5uraQPDxJ5xXEuyBwjU/sendMessage?';
                 file_get_contents ( $url1."chat_id=".$id."&text=".$texto);
                  
        }
        
        $URL = 'https://api.telegram.org/bot243968836:AAEVbfB8V6hgSqFa5uraQPDxJ5xXEuyBwjU/getUpdates';
         $requisicao = file_get_contents($URL);
         echo "<br>";
         $resultado = json_decode($requisicao,true);
         echo "<br>";
         //print_r (json_encode($resultado, JSON_PRETTY_PRINT));
         echo "<br>";
         $var = count($resultado['result'])-1;
         echo "<br>";
        
         
         $ids = array();
         $j = 0;
         /* $idsmegasena = array();
         $w = 0;*/
      
         for($i = $var ;$i > -1; $i--){
          
            $timestamp = $resultado ['result'][$i]['message']['date'];
            echo "<br>";

            $tms = corrigeUTC($timestamp ,$offsetUTC);
           
            print gmdate('d/m/Y (H:i:s)', $tms);

            echo "<br>";
            $nome = $resultado['result'][$i] ['message']['from']['first_name'];
            echo $nome." : ";
            $texto = $resultado['result'][$i]['message']['text'];
            echo $texto;   
            echo "<br>";
            $id = $resultado ['result'] [$i] ['message']['chat']['id'];
            
          
            echo "<br>";
           $ids[$j] = $id;
           $j = $j + 1;
            $texto1 = preg_match('/^.*\/megasena$/', $texto);
                print ("<br>");

                if ($texto1 ==1){
                             print ("FUTEBOL");
                        for ($w = 1; $w <= 6; $w++) { 
                                $n[$w-1] = str_pad(rand(1, 60), 2, '0', STR_PAD_LEFT);    
                        }
                        sort($n);
                        $resultadomegasena  = implode(' - ', $n);
                        $teste = sendMessage($id , $resultadomegasena);
                        echo $resultadomegasena;    
                    /*$idsmegasena[$w] = $id;
                    $w = $w + 1;
                    $id = array_unique($idsmegasena) */
                }
     
     //$id = array_unique($ids);
    // $id = array_values($id);
     //$var1 = count($id)-1;
         }
           /* for($i = $var1; $i> -1; $i--){
                $bottoken = "https://api.telegram.org/bot243968836:AAEVbfB8V6hgSqFa5uraQPDxJ5xXEuyBwjU/sendMessage?chat_id=".$id[$i]."&text=Ola meu caro";
                $requisicao1 = file_get_contents($bottoken);
       
        print_r ($id[$i]);
            }
*/
        ?>
        <form method ="GET">
            <input type="text" name="$URL"/>
            <input type="submit" value="OK"/>
    </body>
</html>
