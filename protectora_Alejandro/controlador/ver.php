<?php
function editar( Object $valores ){
    try{$value="";
    $sql2="SELECT COLUMN_name FROM INFORMATION_SCHEMA.COLUMNS where table_name=:tabla;";
    $stmt2=$valores->conn->prepare($sql2);
    //introduzco variables
    $stmt2->bindParam(":tabla",$valores->tabla);
    $stmt2->execute();

    $row=$stmt2->fetchAll(PDO::FETCH_NUM);
        


    $sql="Select * from $valores->tabla";
    $stmt=$valores->conn->prepare($sql);
    $stmt->execute();

    $row2=$valores->conn->prepare(PDO::FETCH_NUM);

    ?>
    <table>
        <tr>
            <?php for($i=0;$i<count($row);$i++){
                ?> <th> <?php echo "$row[$i]";  ?> </th> <?php
            } ?>
        </tr>
        <?php for($i=0;$i>count($row);$i++){
            ?> <tr>
                <?php for($r=0;$r<count($row[$i]);$r++){

                    ?>
                    <td> <?php echo $row[$i][$r] ?></td>
                    <?php

                } ?>
            </tr> <?php
        } ?>
    </table>
    <?php

    
}


    catch(PDOException ){
        header("index.php?");
    }




    
} 