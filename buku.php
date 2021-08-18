<?php

include "config/koneksi.php";
include "library/oop.php";

$go = new oop();
$tabel = 'tb_buku';
$redirect = '?menu=buku';
$field = array(
    'judul' => @$_POST['judul'],
    'penerbitID' => @$_POST['penerbitID'],
     'pengarang' => @$_POST['pengarang'],

);
@$where = "bukuID = $_GET[id]";

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
        <label class="form-label">Judul</label>
        <input type="text" name="judul" class="form-control" value="<?php echo @$edit['judul'] ?>">
    </div>
       <div class="mb-3">
        <label class="form-label">PenerbitID</label>
        <input type="text" name="penerbitID" class="form-control" value="<?php echo @$edit['penerbitID'] ?>">
    </div>
       <div class="mb-3">
        <label class="form-label">Pengarang</label>
        <input type="text" name="pengarang" class="form-control" value="<?php echo @$edit['pengarang'] ?>">
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
            <th>BukuID</th>
            <th>Judul</th>
            <th>PenerbitID</th>
            <th>Pengarang</th>
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
            <td><?php echo $r['judul'] ?></td>
            <td><?php echo $r['penerbitID'] ?></td>
            <td><?php echo $r['pengarang'] ?></td>


            <td><a class="btn btn-danger" href="?menu=buku&edit&id=<?php echo $r['bukuID'] ?>">Edit</a></td>
            <td><a class="btn btn-success" href="?menu=buku&hapus&id=<?php echo $r['bukuID'] ?>" onclick="return confirm('Hapus data <?php echo $r['bukuID'] ?> ?')">Hapus</a></td>
        </tr>
              <?php }  } ?>

    </tbody>
</table>