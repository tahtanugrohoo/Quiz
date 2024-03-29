<?php

class karyawan
{
    private $db;
    public function __construct($con)
    {
        $this->db = $con;
    }
    ### Start : fungsi insert data ke database ###
    public function insertData($nama, $jenis_kelamin, $tanggal_lahir)
    {
        try {
            $stmt = $this->db->prepare("INSERT INTO karyawan(nama,jenis_kelamin,tanggal_lahir) VALUES(:nama, :jenis_kelamin, :tanggal_lahir)");
            $stmt->bindparam(":nama", $nama);
            $stmt->bindparam(":jenis_kelamin", $jenis_kelamin);
            $stmt->bindparam(":tanggal_lahir", $tanggal_lahir);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    ### End : fungsi insert data ke database ###
    ### Start : fungsi ambil data dari database ###
    public function getID($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM karyawan
         WHERE id=:id");
        $stmt->execute(array(":id" => $id));
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $data;
    }

    ### End: fungsi ambil data dari database ###

    ### Start : fungsi untuk menampilkan data dari database ###

    public function viewData($query)
    {
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                ?>
                <tr>
                    <td><?php echo($row['id']); ?></td>
                    <td><?php echo($row['nama']); ?></td>
                    <td><?php echo($row['jenis_kelamin']); ?></td>
                    <td><?php echo($row['tanggal_lahir']); ?></td>
                    <td align="center">
                        <a href="edit.php?edit_id=<?php echo($row['id']); ?>">
                        <span class="material-symbols-outlined">edit_square</span></a>
                    </td>
                    <td align="center">
                        <a href="hapus.php?delete_id=<?php echo($row['id']); ?>">
                        <span class="material-symbols-outlined">delete</span></a>
                    </td>
                </tr>
                <?php
            }
        } else {
            ?>
            <tr>
                <td>Data tidak ditemukan...</td>
            </tr>
            <?php
        }
    }

    public function updateData($id, $nama, $jenis_kelamin, $tanggal_lahir)
    {
        try {
            $stmt = $this->db->prepare("UPDATE karyawan SET nama=:nama, jenis_kelamin=:jenis_kelamin, tanggal_lahir=:tanggal_lahir WHERE id=:id");
            $stmt->bindparam(":id", $id);
            $stmt->bindparam(":nama", $nama);
            $stmt->bindparam(":jenis_kelamin", $jenis_kelamin);
            $stmt->bindparam(":tanggal_lahir", $tanggal_lahir);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }

    }    public function deleteData($id)
    {
        $stmt = $this->db->prepare("DELETE FROM karyawan WHERE id=:id");
        $stmt->bindparam(":id", $id);
        $stmt->execute();
        return true;
    }

    public function paging($query, $records_per_page)
    {
        $starting_position = 0;
        if (isset($_GET["page_no"])) {
            $starting_position = ($_GET["page_no"] - 1) * $records_per_page;
        }
        $query2 = $query . " limit $starting_position,$records_per_page";
        return $query2;
    }

    public function paginglink($query, $records_per_page)
    {
        $self = $_SERVER['PHP_SELF'];
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $total_no_of_records = $stmt->rowCount();
        if ($total_no_of_records > 0) {
            ?>
            <ul class="pagination"><?php
            $total_no_of_pages = ceil($total_no_of_records / $records_per_page);
            $current_page = 1;
            if (isset($_GET["page_no"])) {
                $current_page = $_GET["page_no"];
            }
            if ($current_page != 1) {
                $previous = $current_page - 1;
                echo "<li><a href='" . $self . "?page_no=1'>First</a></li>";
                echo "<li><a href='" . $self . "?page_no=" . $previous . "'>Previous</a></li>";
            }

            for ($i = 1; $i <= $total_no_of_pages; $i++) {
                if ($i == $current_page) {
                    echo "<li><a href='" . $self . "?page_no=" . $i . "' style='color:red;'>" . $i . "</a></li>";
                } else {
                    echo "<li><a href='" . $self . "?page_no=" . $i . "'>" . $i . "</a></li>";
                }
            }

            if ($current_page != $total_no_of_pages) {
                $next = $current_page + 1;
                echo "<li><a href='" . $self . "?page_no=" . $next . "'>Next</a></li>";
                echo "<li><a href='" . $self . "?page_no=" . $total_no_of_pages . "'>Last</a></li>";
            } ?></ul><?php
        }
    }
}