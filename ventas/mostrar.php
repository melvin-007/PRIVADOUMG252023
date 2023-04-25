<?php
    ob_start();
     session_start();
    
    if(!isset($_SESSION['rol']) || $_SESSION['rol'] != 1){
    header('location: ../login.php');

  }
?>
<?php if(isset($_SESSION['id'])) { ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">
    <title>Web Robots</title>
    <link rel="stylesheet" href="../../backend/css/admin.css">
    <link rel="icon" type="image/png" href="../../backend/img/ca.png">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
     <!-- Data Tables -->
    <link rel="stylesheet" type="text/css" href="../../backend/css/datatable.css">
    <link rel="stylesheet" type="text/css" href="../../backend/css/buttonsdataTables.css">
    <link rel="stylesheet" type="text/css" href="../../backend/css/font.css">
    <style type="text/css">
 .loader-container{
   
}

.load_animation{
  width: 100%;
  height: 100vh;
  font-size: 4rem ;
  background-color: #fff;
  z-index: 500;
  position: fixed;
  top: 0;
  left: 0;
  overflow: hidden;
  
}
.animation {
  position: absolute;
  top: 50%;
  left: 50%;
  border: 3px solid rgb(0, 0, 0);
  border-radius: 50%;
  box-sizing: content-box;
  padding: 10px;
  transform: translate(-50% , -50%) ;
  opacity: .5;
  animation: spinner 1s infinite;
  transition: .1s;
  transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
}
@keyframes spinner {
  50% {
    transform: translate(-50% , -50%) ;
    border: 2px solid rgba(0, 0, 0, 0.178);
    padding: 30px;
  }
  100% {
    opacity: 1;
    transform:translate(-50% , -50%) rotate(360deg);
    border: 3px solid rgba(0, 0, 0, 0);
    padding: 17rem;
    color: #233975;
  }

}


    </style>

</head>
<body>
    <div class="loader-container">
    <div class="load_animation">
        <ion-icon name="bag-handle-outline" class="animation"></ion-icon>
    </div>
</div>
   <input type="checkbox" id="menu-toggle">
    <div class="sidebar">
        <div class="side-header">
            <h3>Web<span>Robots</span></h3>
        </div>
        
        <div class="side-content">
            <div class="profile">
                <div class="profile-img bg-img" style="background-image: url(../../backend/img/user13.png)"></div>
                <h4><?php echo $_SESSION['username']; ?></h4>
                <small>Administrador</small>
            </div>

            <div class="side-menu">
                <ul>
                    <li>
                       <a href="../administrador/escritorio.php">
                            <small>Dashboard</small>
                        </a>
                        <center><div class="profile-img bg-img" style="background-image: url(../../backend/img/escritorio.png)"></div><center/>

                    </li>
                    <li>
                       <a href="../productos/mostrar.php">
                            <small>Robots</small>
                        </a>
                        <center><div class="profile-img bg-img" style="background-image: url(../../backend/img/robots.png)"></div><center/>
                    </li>
                    <li>
                       <a href="../categorias/mostrar.php">
                            <small>Categorias</small>
                        </a>
                        <center><div class="profile-img bg-img" style="background-image: url(../../backend/img/categorias.png)"></div><center/>
                    </li>
                    <li>
                       <a href="../accesos/mostrar.php">
                            <small>Accesos</small>
                        </a>
                        <center><div class="profile-img bg-img" style="background-image: url(../../backend/img/usuarios.png)"></div><center/>
                    </li>
                    <li>
                       <a href="../clientes/mostrar.php">
                            <small>Clientes</small>
                        </a>
                        <center><div class="profile-img bg-img" style="background-image: url(../../backend/img/clientes.png)"></div><center/>
                    </li>
                    <li>
                       <a href="../proveedores/mostrar.php">
                            <small>Proveedores</small>
                        </a>
                        <center><div class="profile-img bg-img" style="background-image: url(../../backend/img/proveedores.png)"></div><center/>
                    </li>

                    <li>
                       <a href="../ventas/venta.php" class="active">
                            <small>Ventas</small>
                        </a> 
                        <center><div class="profile-img bg-img" style="background-image: url(../../backend/img/ventas.png)"></div><center/>
                    </li>

                    <li>
                       <a href="../compra/mostrar.php"> 
                            <small>Compras</small>
                        </a>
                        <center><div class="profile-img bg-img" style="background-image: url(../../backend/img/compras.png)"></div><center/>
                    </li>
                    <li>
                       <a href="../salir.php">
                            <small>Salir</small> 
                        </a>  
                        <center><div class="profile-img bg-img" style="background-image: url(../../backend/img/cerrar.png)"></div><center/>
                    </li>
                </ul>
            </div> 
        </div>
    </div>
    
    <div class="main-content">
        
        <header>
            <div class="header-content">
                <label for="menu-toggle">
                    <span class="las la-bars"></span>
                </label>
                
                <div class="header-menu">
                
                    <div class="user">
                        <div class="bg-img" style="background-image: url(../../backend/img/user13.png)"></div>

                    </div>
                </div>
            </div>
        </header>
        
        <main>
            
            <div class="page-header">
                <h1>Bienvenido <?php echo '<strong>'.$_SESSION['nombre'].'</strong>'; ?></h1>
                <small>Home / Ventas dentro del sistema</small>
            </div>
            
            <div class="page-content">
            
            <div class="records table-responsive">
                     <div class="record-header">
                        <div class="add">
                          
                            <button style="cursor: pointer;" onclick="location.href='nuevo.php'">Nuevo</button>
                        </div>
                    </div>
                    <div>
                        <?php 
require '../../backend/config/Conexion.php';
$sentencia = $connect->prepare("SELECT * FROM pedidos ORDER BY idord DESC;");
 $sentencia->execute();
$data =  array();
if($sentencia){
  while($r = $sentencia->fetchObject()){
    $data[] = $r;
  }
}
     ?>
     <?php if(count($data)>0):?>
                        <table width="100%" id="example">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th><span class="las la-sort"></span>Comprobante</th>
                                    <th><span class="las la-sort"></span>Fecha</th>
                                    <th><span class="las la-sort"></span>Total</th>
                                    <th><span class="las la-sort"></span>Cliente</th>
                                    <th><span class="las la-sort"></span>Robots</th>

                                    <th><span class="las la-sort"></span>Estado</th>
                                    <th><span class="las la-sort"></span>Acciones</th>
                                  
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($data as $d):?>
                                <tr>
                                    <td><?php echo $d->idord ?></td>
                                    <td><h4><?php echo $d->tipc ?></h4></td>
                                    <td><h4><?php echo $d->placed_on ?></h4></td>
                                    <td><h4>S/<?php echo number_format($d->total_price, 2); ?></h4></td>
                                    <td>
                                        <div class="client">
                                           
                                            <div class="client-info">
                                                <h4><?php echo $d->nomcl ?></h4>
                                               
                                            </div>
                                        </div>
                                    </td>
                                    <td><h4><?php echo $d->total_products ?></h4></td>
                                    <td data-title="Estado">
    
                        <label class="switch">
                          <input type="checkbox" id="<?=$d->idord?>" value="<?=$d->payment_status ?>" <?=$d->payment_status == 'Aceptado' ? 'checked' : '' ;?>/> 

                          <span class="slider"></span>
                        </label>
                        </td>
        <td>
            
            <a title="Boleta" href="../ventas/boleta.php?id=<?php echo $d->idord ?>" class="fa fa-file-text-o tooltip"></a>
        </td>
                    
                                   
                                   
                                   
                                </tr>
                                 <?php endforeach; ?>
                                
                            </tbody>
                        </table>
                          <?php else:?>
                           <div class="alert">
      <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
      <strong>Danger!</strong> No hay datos.
    </div>
    <?php endif; ?>
                    </div>

                </div>
            
            </div>
            
        </main>
        
    </div>
    <script src="../../backend/js/jquery.min.js"></script>
    <!-- Data Tables -->
    <script type="text/javascript" src="../../backend/js/datatable.js"></script>
    <script type="text/javascript" src="../../backend/js/datatablebuttons.js"></script>
    <script type="text/javascript" src="../../backend/js/jszip.js"></script>
    <script type="text/javascript" src="../../backend/js/pdfmake.js"></script>
    <script type="text/javascript" src="../../backend/js/vfs_fonts.js"></script>
    <script type="text/javascript" src="../../backend/js/buttonshtml5.js"></script>
    <script type="text/javascript" src="../../backend/js/buttonsprint.js"></script>
    <script type="text/javascript">
$(document).ready(function() {
    $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );
} );
    </script>
    <script type="text/javascript">
        $(window).on("load",function(){
            $(".load_animation").fadeOut(1000);
        });
    </script>

     <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
   
</body>
</html>

<?php }else{ 
    header('Location: ../login.php');
 } ?>