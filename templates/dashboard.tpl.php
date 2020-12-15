<head>
    <style>
        table {
            margin-top: 30px;
            width:100%;
            display: flex;
            justify-content:center; 
            align-items:center;
            text-align:center;
            margin-bottom: 50px; 
        }
        td, th {
            border: black 2px solid;
        }
        form{
            width:100%;
            display: flex;
            justify-content:center;   
        }
    </style>
</head>

<?php

    include 'templates/header.tpl.php';
    ?>
    
    <main><h1><?= $title; ?></h1>
    <table class="egt">
  <tr>
    <th>ID</th>
    <th>DESCRIPCION</th>
    <th>FECHA</th>
    <th>USUARIO</th>
  </tr>

  <tr>
    <td><?php 
                use APP\View;
                use APP\Model;
                use APP\Controller;
                use APP\Request;
                use APP\Session;
                use APP\DB;
                
                $uname=$_SESSION['uname'];
                $db = $this->getDB();
                $looktaskid=$db->looktaskid($db,$uname);
                ?></td>
        <td><?php 
                $looktaskdesc=$db->looktaskdesc($db,$uname);
                ?>
                <br>
                </td>
        <td><?php 
                $looktaskdate=$db->looktaskdate($db,$uname);
        ?></td>
        <td><?php 
                $looktaskuser=$db->looktaskuser($db,$uname);
        ?></td>
  </tr>
</table>
        <form method="POST" action="dashaction">
            <input type="text" name="descripcion">
            <input type="date" name="fecha">
            <input type="submit" value="Añadir">
        </form>

        <form method="POST" action="deldashaction">
            <input type="number" name="id_task">
            <input type="submit" value="Eliminar">
        </form>
</main>

<?php
    include 'templates/footer.tpl.php';
    ?>