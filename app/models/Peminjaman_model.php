<?php

class Peminjaman_model
{
    private $table = 'trx_peminjaman';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAllPeminjaman()
    {
        $query =
        'SELECT *
                  FROM trx_peminjaman tp
                  LEFT JOIN mst_user mu ON tp.id_user = mu.id_user
                  LEFT JOIN mst_ruangan mr ON tp.id_ruangan = mr.id_ruangan 
                  WHERE status_peminjaman != "Ditolak"';

        $this->db->query($query);

        return $this->db->resultSet();
    }

    public function getAllPeminjamanByUserId($id_user)
    {
        $query = "SELECT * FROM trx_peminjaman tp
        LEFT JOIN mst_ruangan tr ON tp.id_ruangan = tr.id_ruangan
         WHERE tp.id_user = :id_user";
        $this->db->query($query);
        $this->db->bind(':id_user', $id_user);
        return $this->db->resultSet();
    }


    public function getPeminjamanById($id)
    {
        $this->db->query('SELECT * FROM trx_peminjaman tp
        JOIN mst_ruangan mr ON tp.id_ruangan = mr.id_ruangan
        JOIN mst_user mu ON tp.id_user = mu.id_user
        WHERE id_peminjaman=:id_peminjaman');
        $this->db->bind('id_peminjaman', $id);
        return $this->db->single();
    }

    public function tambahDataPeminjaman($data, $id_user)
    {

        try {

            $file = $this->uploadFile();

            if (!$file) {
                return false;
            }

            $status_peminjaman = 'Pending';


            $query = "INSERT INTO trx_peminjaman (id_user, id_ruangan, tanggal_pinjam, waktu_mulai, waktu_selesai, keperluan, jumlah_peserta, file, status_peminjaman) 
          VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

            $this->db->query($query);
            $this->db->bind(1, $id_user);
            $this->db->bind(2, $data['id_ruangan']);
            $this->db->bind(3, $data['tanggal_pinjam']);
            $this->db->bind(4, $data['waktu_mulai']);
            $this->db->bind(5, $data['waktu_selesai']);
            $this->db->bind(6, $data['kegiatan']);
            $this->db->bind(7, $data['jumlah_peserta']);
            $this->db->bind(8, $file);
            $this->db->bind(9, $status_peminjaman);

            $this->db->execute();

            return $this->db->rowCount();
        } catch (Exception $e) {
            echo $e;
        }
    }

    function uploadFile()
    {
        // Mengambil informasi file
        $namaFile = $_FILES['file_dokumen']['name'];
        $tmpName = $_FILES['file_dokumen']['tmp_name'];
        $ukuranFile = $_FILES['file_dokumen']['size'];
        $error = $_FILES['file_dokumen']['error'];

        // cek apakah tidak ada file yang diupload
        if ($error === 4) {
            echo '<div class="alert alert-danger" role="alert">Pilih file terlebih dahulu!</div>';
            return false;
        }

        // cek ekstensi file
        $ekstensiFileValid = ['pdf'];
        $ekstensiFile = explode('.', $namaFile);
        $ekstensiFile = strtolower(end($ekstensiFile));
        if (!in_array($ekstensiFile, $ekstensiFileValid)) {
            echo "<script>
        alert('Yang anda upload bukan file PDF!');
        </script>";
            return false;
        }

        // cek ukuran file (maksimum 10 MB)
        $maxFileSize = 10 * 1024 * 1024; // 10 MB dalam bytes
        if ($ukuranFile > $maxFileSize) {
            echo "<script>
        alert('Ukuran file terlalu besar! Maksimum 10MB.');
        </script>";
            return false;
        }

        // lolos pengecekan, file siap diupload
        // generate nama file baru
        $namaFileBaru = uniqid();
        $namaFileBaru .= '.';
        $namaFileBaru .= $ekstensiFile;

        move_uploaded_file($tmpName, 'pdf_files/' . $namaFileBaru);

        return $namaFileBaru;
    }

    public function getTotalPeminjaman()
    {
        $query = "SELECT COUNT(*) as total_peminjaman FROM trx_peminjaman";

        $this->db->query($query);
        $result = $this->db->single();

        return $result['total_peminjaman'];
    }

    // Fungsi untuk mengubah status peminjaman menjadi "Disetujui"
    public function setujuiPeminjaman($id_peminjaman)
    {
        $query = 'UPDATE trx_peminjaman SET status_peminjaman = "Disetujui" WHERE id_peminjaman = :id';
        $this->db->query($query);
        $this->db->bind(':id', $id_peminjaman);
        $this->db->execute();

        return $this->db->rowCount();
    }

    // Fungsi untuk mengubah status peminjaman menjadi "Ditolak"
    public function tolakPeminjaman($idPeminjaman)
    {
        $this->db->query('UPDATE trx_peminjaman SET status_peminjaman = "Ditolak" WHERE id_peminjaman = :id');
        $this->db->bind(':id', $idPeminjaman);

        $this->db->execute();
        return $this->db->rowCount();
    }

    // Fungsi untuk membatalkan peminjaman
    public function cancelPeminjaman($idPeminjaman)
    {
        $this->db->query('UPDATE trx_peminjaman SET status_peminjaman = "Dibatalkan" WHERE id_peminjaman = :id');
        $this->db->bind(':id', $idPeminjaman);
        $this->db->execute();
        return $this->db->rowCount();
    }

    // Fungsi untuk mengambil data peminjaman berdasarkan status
    public function getPeminjamanByStatus($status)
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE status_peminjaman = :status');
        $this->db->bind(':status', $status);
        return $this->db->resultSet();
    }

    public function countApprovedPeminjaman()
    {
        $query = "SELECT COUNT(*) AS total FROM trx_peminjaman WHERE status_peminjaman = 'Disetujui'";
        $this->db->query($query);
        $this->db->execute();
        return $this->db->single()['total'];
    }

    public function countRejectedPeminjaman()
    {
        $query = "SELECT COUNT(*) AS total FROM trx_peminjaman WHERE status_peminjaman = 'Ditolak'";
        $this->db->query($query);
        $this->db->execute();
        return $this->db->single()['total'];
    }

    public function countApprovedPeminjamanPerUser($id_user)
    {
        $query = "SELECT COUNT(*) AS total FROM trx_peminjaman WHERE id_user = :id_user AND status_peminjaman = 'Disetujui'";
        $this->db->query($query);
        $this->db->bind(':id_user', $id_user);
        $this->db->execute();
        return $this->db->single()['total'];
    }

    public function countRejectedPeminjamanByUser($id_user)
    {
        $query = "SELECT COUNT(*) AS total FROM trx_peminjaman WHERE id_user = :id_user AND status_peminjaman = 'Ditolak'";
        $this->db->query($query);
        $this->db->bind(':id_user', $id_user);
        $this->db->execute();
        return $this->db->single()['total'];
    }

    public function countPeminjamanPerUser($id_user)
    {
        $query = "SELECT COUNT(*) AS total FROM trx_peminjaman WHERE id_user = :id_user";
        $this->db->query($query);
        $this->db->bind(':id_user', $id_user);
        $this->db->execute();
        return $this->db->single()['total'];
    }

    // public function getRuanganIdByPeminjamanId($id_peminjaman)
    // {
    //     $query = "SELECT id_ruangan FROM trx_peminjaman WHERE id_peminjaman = :id_peminjaman";
    //     $this->db->query($query);
    //     $this->db->bind(':id_peminjaman', $id_peminjaman);
    //     return $this->db->single()['id_ruangan'];
    // }

    public function kembalikanPeminjaman($id_peminjaman){
        $this->db->query('UPDATE trx_peminjaman SET status_pengembalian = "selesai" WHERE id_peminjaman = :id');
        $this->db->bind(':id', $id_peminjaman);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function getPeminjamanDikembalikan()
    {
        $query = 'SELECT * FROM trx_peminjaman  tp
        JOIN mst_user mt ON tp.id_user = mt.id_user
        JOIN mst_ruangan mr ON tp.id_ruangan = mr.id_ruangan
        WHERE status_pengembalian = "selesai"';
        $this->db->query($query);
        return $this->db->resultSet();
    }

    public function getRiwayatPeminjaman($id_user){
        $query = 'SELECT * FROM trx_peminjaman tp 
        JOIN mst_user mu ON tp.id_user = mu.id_user
        JOIN mst_ruangan mr ON tp.id_ruangan = mr.id_ruangan
        WHERE tp.status_pengembalian = "selesai" AND tp.id_user = :id_user' ;

        $this->db->query($query);
        $this->db->bind('id_user', $id_user);
        return $this->db->resultSet();
    }

    public function countPeminjamanByRoom($id_ruangan)
    {
        $query = "SELECT COUNT(*) AS total_peminjaman FROM trx_peminjaman tp
        JOIN mst_ruangan mr ON tp.id_ruangan = mr.id_ruangan 
        WHERE tp.id_ruangan = :id_ruangan AND status_pengembalian = 'selesai'";

        $this->db->query($query);
        $this->db->bind('id_ruangan', $id_ruangan);
        $this->db->execute();
        $result = $this->db->single();
        return $result['total_peminjaman'];
    }

    public function getPeminjamanBydate($start_date, $end_date)
    {
        $query = "SELECT * FROM trx_peminjaman tp
        JOIN mst_user mu ON tp.id_user = mu.id_user
        JOIN mst_ruangan mr ON tp.id_ruangan = mr.id_ruangan
        WHERE tp.tanggal_pinjam BETWEEN :start_date AND :end_date";
        $this->db->query($query);
        $this->db->bind(':start_date', $start_date);
        $this->db->bind(':end_date', $end_date);
        $this->db->execute();

        return $this->db->resultSet();
    }

    public function getPeminjamanByRuangan($nama_ruangan){
        // $query =
        // "SELECT * FROM trx_peminjaman tp
        //  WHERE tp.id_ruangan IN (SELECT id_ruangan FROM mst_ruangan WHERE nama_ruangan = :nama_ruangan) AND tp.status_peminjaman = 'Disetujui'";

        $query = "SELECT *
                  FROM trx_peminjaman tp
                  LEFT JOIN mst_user mu ON tp.id_user = mu.id_user
                  LEFT JOIN mst_ruangan mr ON tp.id_ruangan = mr.id_ruangan 
                  WHERE mr.nama_ruangan = :nama_ruangan AND tp.status_peminjaman = 'Disetujui'";
        $this->db->query($query);
        $this->db->bind(':nama_ruangan', $nama_ruangan);
        return $this->db->resultSet();
    }

}
