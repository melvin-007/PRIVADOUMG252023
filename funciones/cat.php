 <?php 
 require '../../backend/config/Conexion.php';
 echo '<option value="0">Seleccione</option>';
 $stmt = $connect->prepare('SELECT * FROM `categoria` ORDER BY idcate  ASC');

  $stmt->execute();


  while($row=$stmt->fetch(PDO::FETCH_ASSOC))
        {
            extract($row);
            ?>
            <option value="<?php echo $idcate ; ?>"><?php echo $nocate; ?></option>

            <?php
        }

  ?>


