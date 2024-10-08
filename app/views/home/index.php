            <?php if ($_SESSION['role'] == 'Koordinator Lab' || $_SESSION['level'] == 1) : ?>
                <!-- Card peminjaman-->
                <div class="row mb-3">

                    <div class="col-md-4 col-xl-3 mb-3">
                        <div class="card h-100 border-0">
                            <div class="card-block d-flex justify-content-between">
                                <div>
                                    <h6>Peminjaman</h6>
                                    <h2><span>0</span></h2>
                                    <p>Total Peminjaman</p>
                                </div>
                                <div>
                                    <img src=" <?= BASEURL ?>/img/pinjam.svg" alt="Mahasiswa">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-xl-3 mb-3">
                        <div class="card h-100 border-0">
                            <div class="card-block d-flex justify-content-between">
                                <div>
                                    <h6>Disetujui</h6>
                                    <h2><span>0</span></h2>
                                    <p>Peminjaman yang disetujui</p>
                                </div>
                                <div>
                                    <img src="<?= BASEURL ?>/img/disetujui.svg" alt="Koordinator Lab">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-xl-3 mb-3">
                        <div class="card h-100 border-0">
                            <div class="card-block d-flex justify-content-between">
                                <div>
                                    <h6>Tidak Disetujui</h6>
                                    <h2><span>0</span></h2>
                                    <p>Peminjaman tidak disetujui</p>
                                </div>
                                <div>
                                    <img src="<?= BASEURL ?>/img/ditolak.svg" alt="admin">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-xl-3 mb-3">
                        <div class="card h-100 border-0">
                            <div class="card-block d-flex justify-content-between">
                                <div>
                                    <h6>Dibatalkan</h6>
                                    <h2><span>0</span></h2>
                                    <p>Peminjaman yang dibatalkan</p>
                                </div>
                                <div>
                                    <img src="<?= BASEURL ?>/img/dibatalkan.svg" alt="Kepala Lab">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Card -->
                <div class="col-xl-8 col-lg-7">
                    <div class="card shadow-sm border-0 mb-4">
                        <div class="card-header py-3">
                            <h6>Statistik Peminjaman IOT</h6>
                        </div>
                        <div class="card-body">
                            <div class="chart-line pt-4">
                                <canvas id="myLineChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            <?php elseif ($_SESSION['role'] == 'User' || $_SESSION['level'] == 0) : ?>
                <!-- Card -->
                <div class="row">
                    <div class="col-md-4 col-xl-3 mb-4">
                        <div class="card">
                            <div class="card-block d-flex justify-content-between">
                                <div>
                                    <img src="<?= BASEURL ?>/img/ruangan.svg" alt="Total ruangan" class="mb-3">
                                    <h6>Ruangan Tersedia</h6>
                                    <h2><span><?= $data['Tersedia'] ?></span></h2>
                                    <p>Total Tersedia saat ini</p>
                                </div>
                                <div>
                                    <i class=" fa-solid fa-ellipsis-vertical"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-xl-3 mb-4">
                        <div class="card">
                            <div class="card-block d-flex justify-content-between">
                                <div>
                                    <img src="<?= BASEURL ?>/img/pengguna.svg" alt="Total pengguna" class="mb-3">
                                    <h6>Total Peminjaman</h6>
                                    <h2><span><?= $data['Peminjaman'] ?></span></h2>
                                    <p>Total Peminjaman</p>
                                </div>
                                <div>
                                    <i class=" fa-solid fa-ellipsis-vertical"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-xl-3 mb-4">
                        <div class="card">
                            <div class="card-block d-flex justify-content-between">
                                <div>
                                    <img src="<?= BASEURL ?>/img/jurusan.svg" alt="Total jurusan" class="mb-3">
                                    <h6>Peminjaman Disetujui</h6>
                                    <h2><span><?= $data['Disetujui'] ?></span>
                                    </h2>
                                    <p>Total Peminjaman disetujui</p>
                                </div>
                                <div>
                                    <i class=" fa-solid fa-ellipsis-vertical"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-xl-3 mb-4">
                        <div class="card">
                            <div class="card-block d-flex justify-content-between">
                                <div>
                                    <img src="<?= BASEURL ?>/img/peminjaman.svg" alt="Total peminjaman" class="mb-3">
                                    <h6>Peminjaman Ditolak</h6>
                                    <h2><span><?= $data['Ditolak'] ?></span>
                                    </h2>
                                    <p>Total peminjaman ditolak</p>
                                </div>
                                <div>
                                    <i class=" fa-solid fa-ellipsis-vertical"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-container-1 ">
                    <div class="row">
                        <div class="col">
                            <h5>Riwayat Peminjaman Kosong!</h5>
                            <img src="<?= BASEURL ?>/img/4660894_2456048.svg">
                        </div>
                    </div>
                </div>

            <?php else : ?>
                <!-- Card -->
                <div class="row">
                    <div class="col-md-4 col-xl-3 mb-4">
                        <div class="card border-0 shadow-sm">
                            <div class="card-block d-flex justify-content-between">
                                <div>
                                    <img src="..\public\img\ruangan.svg" alt="Total ruangan" class="mb-3">
                                    <h6>Total Ruangan</h6>
                                    <h2><span><?php echo $data['jumlahTotalRuangan']; ?></span></h2>
                                    <p>Total Ruangan yang dimiliki</p>
                                </div>
                                <div>
                                    <i class=" fa-solid fa-ellipsis-vertical"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-xl-3 mb-4">
                        <div class="card">
                            <div class="card-block d-flex justify-content-between">
                                <div>
                                    <img src="..\public\img\pengguna.svg" alt="Total pengguna" class="mb-3">
                                    <h6>Total Pengguna</h6>
                                    <h2><span><?php echo $data['totalPengguna']; ?></span></h2>
                                    <p>Total Pengguna saat ini</p>
                                </div>
                                <div>
                                    <i class=" fa-solid fa-ellipsis-vertical"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-xl-3 mb-4">
                        <div class="card">
                            <div class="card-block d-flex justify-content-between">
                                <div>
                                    <img src="..\public\img\jurusan.svg" alt="Total jurusan" class="mb-3">
                                    <h6>Total Jurusan</h6>
                                    <h2><span><?php echo $data['jumlahJurusan'];  ?></span></h2>
                                    <p>Total Jurusan saat ini</p>
                                </div>
                                <div>
                                    <i class=" fa-solid fa-ellipsis-vertical"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-xl-3 mb-4">
                        <div class="card">
                            <div class="card-block d-flex justify-content-between">
                                <div>
                                    <img src="..\public\img\peminjaman.svg" alt="Total peminjaman" class="mb-3">
                                    <h6>Total Peminjaman</h6>
                                    <h2><span><?php echo $data['total_peminjaman']; ?></span></h2>
                                    <p>Total peminjaman dari awal</p>
                                </div>
                                <div>
                                    <i class=" fa-solid fa-ellipsis-vertical"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-8 col-lg-7">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6>Statistik Peminjaman</h6>
                            </div>
                            <div class="card-body">
                                <div class="chart-bar pt-4">
                                    <canvas id="myBarChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-5">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6>Pengguna Per Jurusan</h6>
                            </div>
                            <div class="card-body">
                                <div class="chart-pie pt-4">
                                    <canvas id="myPieChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif ?>


            <script>
                const ctb = document.getElementById('myBarChart');
                const ctp = document.getElementById('myPieChart');
                const ctl = document.getElementById('myLineChart');

                new Chart(ctb, {
                    type: 'bar',
                    data: {
                        labels: [
                            <?php foreach ($data['dataRuanganPeminjaman'] as $item) : ?> '<?= $item['nama_ruangan'] ?>',
                            <?php endforeach; ?>
                        ],
                        datasets: [{
                            label: 'Ruangan Yang Dipinjam',
                            data: [<?php foreach ($data['dataRuanganPeminjaman'] as $item) : ?>
                                    <?= $item['jumlah_peminjaman'] ?>,
                                <?php endforeach; ?>
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        plugins: {
                            legend: {
                                display: false
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });

                new Chart(ctp, {
                    type: 'pie',
                    data: {
                        labels: [<?php foreach ($data['dataJurusanPengguna'] as $user) : ?> '<?= $user['nama_jurusan'] ?>', <?php endforeach; ?>],
                        datasets: [{
                            label: 'Pengguna',
                            data: [<?php foreach ($data['dataJurusanPengguna'] as $user) : ?><?= $user['jumlah_pengguna'] ?>, <?php endforeach; ?>],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        plugins: {
                            legend: {
                                display: true,
                                labels: {
                                    usePointStyle: true,
                                    boxHeight: 8,
                                    padding: 20

                                },
                                position: 'right'

                            }
                        }
                    }
                });

                new Chart(ctl, {
                    type: 'line',
                    data: {
                        labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
                        datasets: [{
                            label: '# of Votes',
                            data: [12, 19, 3, 5, 2, 3],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            </script>