<?php

include "config/koneksi.php";
include "library/oop.php";

$go = new oop();
$tabel = 'tb_penerbit';
$redirect = '?menu=penerbit';
$field = array(
    'penerbit' => @$_POST['penerbit']
);
@$where = "penerbitID = $_GET[id]";

if(isset($_POST['simpan'])){
    $go->simpan($con, $tabel, $field, $redirect);
  }

if(isset($_GET['hapus'])){
    $go->hapus($con, $tabel, $where, $redirect);
  }

if(isset($_GET['edit'])){
    $edit = $go->edit($con, $tabel, $where);
}

if(isset($_POST['ubah'])){
    $go->ubah($con, $tabel, $field, $where, $redirect);
}

?>

<form method="post">

    <div class="mb-3">
        <label class="form-label">Penerbit</label>
        <input type="text" name="penerbit" class="form-control" value="<?php echo @$edit['penerbit'] ?>">
    </div>

        <?php if(@$_GET['id']=="") { ?>
        <input class="btn btn-primary" type="submit" name="simpan" value="SIMPAN">
        <?php }else{ ?>
        <input class="btn btn-success" type="submit" name="ubah" value="UPDATE">
        <?php } ?>

</form>

<br>

<table id="example" class="display" style="width:100%">
    <thead>
        <tr>
            <th>PenerbitID</th>
            <th>Penerbit</th>
            <th>Aksi</th>
            <th></th>

        </tr>
    </thead>
    <tbody>

        <?php
            $a = $go->tampil($con, $tabel);
            $no = 0;

            if($a == ""){
                echo "<tr><td>No Record</td></tr>";
            } else {

            foreach($a as $r){
            $no++;
        ?>
        <tr>
            <td><?php echo $no ?></td>
            <td><?php echo $r['penerbit'] ?></td>
            <td><a class="btn btn-danger" href="?menu=penerbit&edit&id=<?php echo $r['penerbitID'] ?>">Edit</a></td>
            <td><a class="btn btn-success" href="?menu=penerbit&hapus&id=<?php echo $r['penerbitID'] ?>" onclick="return confirm('Hapus data <?php echo $r['penerbit'] ?> ?')">Hapus</a></td>
        </tr>
              <?php }  } ?>

    </tbody>
</table>