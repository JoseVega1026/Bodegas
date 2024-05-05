<?php
   require_once "../../../conexion.php";
   
   $id = $_GET['u'];
   $sql = "SELECT * FROM usuarios WHERE id = $id";
   $result = mysqli_query($link,$sql);
   while($row = mysqli_fetch_array($result)) {
     $usuario = $row['usuario'];
   }
   
   $id_pedido = $_GET['id'];
   $sql_pedido = "SELECT * FROM pedidos_usuario WHERE id = $id_pedido";
   $result_pedido = mysqli_query($link,$sql_pedido);
   while($row = mysqli_fetch_array($result_pedido)) {
     $cod_envio = $row['cod_envio'];
     $total_pedido = $row['total_pedido'];
     $direccion = $row['direccion'];
   }
   ?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Nuevo pedido | Sistema de Inventario</title>
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
      <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
      <link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
      <link rel="stylesheet" href="../../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
      <link rel="stylesheet" href="../../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
     
      <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
   </head>
   <body class="hold-transition sidebar-mini">
      <div class="wrapper">
         
         <aside class="main-sidebar sidebar-dark-primary elevation-4">
           
            <a href="index3.html" class="brand-link">
            <span class="brand-text font-weight-light">Sistema de Inventario</span>
            </a>
            
            <div class="sidebar">
              
               <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                  <div class="image">
                     <img src="../../dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
                  </div>
                  <div class="info">
                     <a href="#" class="d-block"><?php echo $usuario; ?></a>
                  </div>
               </div>
             
               <nav class="mt-2">
                  <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
               
                     <li class="nav-item menu-open">
                        <a href="../../index.php?u=<?php echo $id?>" class="nav-link">
                           <i class="nav-icon fas fa-tachometer-alt"></i>
                           <p>
                              Dashboard
                           </p>
                        </a>
                     </li>
                     <li class="nav-item menu-open">
                        <a href="#" class="nav-link active">
                           <i class="nav-icon fas fa-table"></i>
                           <p>
                              Pedidos
                              <i class="fas fa-angle-left right"></i>
                           </p>
                        </a>
                        <ul class="nav nav-treeview">
                           <li class="nav-item">
                              <a href="./pedido.php?u=<?php echo $id; ?>" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>Ver pedidos</p>
                              </a>
                           </li>
                           <li class="nav-item">
                              <a href="./nuevo_pedido.php?u=<?php echo $id; ?>" class="nav-link active">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>Nuevo pedido</p>
                              </a>
                           </li>
                        </ul>
                     </li>
                     <li class="nav-item menu-open">
                        <a href="../../../cerrar-sesion.php?>">
                           <p>
                              Cerrar sesion
                           </p>
                        </a>
                     </li>
                  </ul>
               </nav>
              
            </div>
           
         </aside>
       
         <div class="content-wrapper">
            
            <section class="content-header">
               <div class="container-fluid">
                  <div class="row mb-2">
                     <div class="col-sm-6">
                        <h1>Registro nuevo pedido para <?php echo $usuario; ?></h1>
                     </div>
                     <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                           <li class="breadcrumb-item"><a href="#">Home</a></li>
                           <li class="breadcrumb-item active">Nuevo pedido</li>
                        </ol>
                     </div>
                  </div>
               </div>
               
            </section>
          
            <section class="content">
               <div class="container-fluid">
                 
                  <div class="card card-default">
                     <div class="card-header">
                        <h3 class="card-title">Formulario de soilicitud nuevo pedido</h3>
                        <div class="card-tools">
                           <button type="button" class="btn btn-tool" data-card-widget="collapse">
                           <i class="fas fa-minus"></i>
                           </button>
                           <button type="button" class="btn btn-tool" data-card-widget="remove">
                           <i class="fas fa-times"></i>
                           </button>
                        </div>
                     </div>
                    
                     <div class="card-body">
                        <form method="post" action="procesa_editar.php">
                           <div class="row">
                              <div class="col-md-6">
                                 <div class="form-group">
                                  
                                    <input type="hidden" id="id_pedido" name="id_pedido" value="<?php echo $id_pedido; ?>">
                                    <input type="hidden" id="id_usuario" name="id_usuario" value="<?php echo $id; ?>">
                                   
                                    <div class="form-group">
                                       <label>Departamento:</label>
                                       <select id="departamento" name="departamento" class="form-control" required>
                                          <option value="">Selecciona un departamento</option>
                                          <?php
                                           
                                             $query = "SELECT * FROM departamentos";
                                             $result = mysqli_query($link, $query);
                                             
                                            
                                             while ($row = mysqli_fetch_assoc($result)) {
                                                 echo '<option value="'.$row['id_departamento'].'">'.$row['departamento'].'</option>';
                                             }
                                             ?>
                                       </select>
                                    </div>
                                    <div class="form-group">
                                       <label>Municipio:</label>
                                       <select id="municipio" name="municipio" class="form-control" required>
                                          <option value="">Selecciona un municipio</option>
                                       </select>
                                    </div>
                                 </div>
                              </div>
                              
                              <div class="col-md-6">
                                 <div class="form-group">
                                    <label>Codigo </label>
                                    <input type="text" id="cod_envio" name="cod_envio" class="form-control" value="<?php echo $cod_envio; ?>" required>
                                 </div>
                               
                                 <div class="form-group">
                                    <label>Precio </label>
                                    <input type="number" id="total_pedido" name="total_pedido" class="form-control" value="<?php echo $total_pedido; ?>" required>
                                 </div>
                                 
                              </div>
                             
                           </div>
                           
                           <div class="row">
                              <div class="col-12 col-sm-6">
                                 <div class="form-group">
                                    <label>Descripcion y marca</label>
                                    <input type="text" id="direccion" name="direccion" class="form-control" value="<?php echo $direccion; ?>" required>
                                 </div>
                                 
                              </div>
                           
                              <div class="col-12 col-sm-6">
                                 <div class="form-group">
                                    <label>&nbsp;</label>
                                    <button type="submit" class="btn btn-warning form-control">Editar</button>
                                 </div>
                            
                              </div>
                           
                           </div>
                           
                        </form>
                     </div>
              
                     <div class="card-footer">
                        
                     </div>
                  </div>
                
               </div>
               
            </section>
           
         </div>
        
       
         <aside class="control-sidebar control-sidebar-dark">
           
         </aside>
         
      </div>
     
      <script src="../../plugins/jquery/jquery.min.js"></script>
      
      <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    
      <script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
      <script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
      <script src="../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
      <script src="../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
      <script src="../../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
      <script src="../../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
      <script src="../../plugins/jszip/jszip.min.js"></script>
      <script src="../../plugins/pdfmake/pdfmake.min.js"></script>
      <script src="../../plugins/pdfmake/vfs_fonts.js"></script>
      <script src="../../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
      <script src="../../plugins/datatables-buttons/js/buttons.print.min.js"></script>
      <script src="../../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
      <script>
         
         $(document).ready(function() {
             $('#departamento').change(function() {
                 var departamentoId = $(this).val();
         
                
                 $.ajax({
                     url: 'get_municipios.php', 
                     type: 'POST',
                     data: {departamentoId: departamentoId},
                     success: function(response) {
                        
                         $('#municipio').html(response);
                     }
                 });
             });
         });
      </script>
   
      <script src="../../dist/js/adminlte.min.js"></script>
      
      <script>
         $(function () {
           $("#example1").DataTable({
             "responsive": true, "lengthChange": false, "autoWidth": false,
             "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
           }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
           $('#example2').DataTable({
             "paging": true,
             "lengthChange": false,
             "searching": false,
             "ordering": true,
             "info": true,
             "autoWidth": false,
             "responsive": true,
           });
         });
      </script>
   </body>
</html>