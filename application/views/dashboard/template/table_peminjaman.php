<div>
    <button class="btn btn-primary" id="add" role="button">Tambah Peminjaman</button>
</div>
<!-- bootstrap modal -->
<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="label">Tambah Peminjaman</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="<?php echo $this->config->config['base_url'] . 'peminjaman' ?>">
                    <input type="hidden" id="act" name="action" value="add">
                    <input type="hidden" id="id_modal" name="id" value="add">
                    <div class="form-group">
                        <label for="id_peminjaman">ID Peminjaman</label>
                        <input type="text" class="form-control" id="id_peminjaman" placeholder="ID Peminjaman" name="id_peminjaman">
                    </div>
                    <div class="form-group">
                        <label for="mahasiswa">Mahasiswa</label>
                        <select name='mahasiswa' id="mahasiswa" class="form-control" aria-label="Default select example" required data-live-search="true">
                            <option selected value="">Pilih Mahasiswa</option>
                            <?php
                            $mahasiswa = $this->mahasiswa_model->get();

                            foreach ($mahasiswa as $mhs) :
                            ?>
                                <option data-tokens="<?php echo $mhs->fullname ?>" value="<?php echo $mhs->id ?>"><?php echo $mhs->fullname ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="buku">Buku</label>
                        <select name='buku' id="buku" class="form-control" aria-label="Default select example" required data-live-search="true">
                            <option selected value="">Pilih Buku</option>
                            <?php
                            $buku = $this->buku_model->get();

                            foreach ($buku as $book) :
                            ?>
                                <option data-tokens="<?php echo $book->judul ?>" value="<?php echo $book->id ?>"><?php echo $book->judul ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="tanggal_pinjam">Tanggal Pinjam</label>
                        <input type="date" class="form-control" id="tanggal_pinjam" name="tanggal_pinjam">
                    </div>
                    <div class="form-group">
                        <label for="tanggal_kembali">Tanggal Kembali</label>
                        <input type="date" class="form-control" id="tanggal_kembali" name="tanggal_kembali">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Kirim</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- end bootstrap modal -->
<div class="mt-3" id="jsGrid"></div>

<script src="<?php echo $this->config->config['base_url']; ?>template/jsgrid/jsgrid.min.js"></script>
<script>
    $(document).ready(() => {
        $('select').selectpicker()
    })
    let id_peminjaman = document.getElementById('id_peminjaman'),
        mahasiswa = document.getElementById('mahasiswa'),
        buku = document.getElementById('buku'),
        tanggal_pinjam = document.getElementById('tanggal_pinjam'),
        tanggal_kembali = document.getElementById('tanggal_kembali'),
        id = document.getElementById('id_modal'),
        action = document.getElementById('act');

    

    clear = () => {
        id_peminjaman.value = null;
        Array.prototype.forEach.call(mahasiswa.children, (el) => {
            el.setAttribute('selected', false);
        });
        Array.prototype.forEach.call(buku.children, (el) => {
            el.setAttribute('selected', false);
        });
        buku.value = null;
        tanggal_pinjam.value = null;
        tanggal_kembali.value = null;
        $('select').selectpicker('refresh')
    }

    document.getElementById('add').addEventListener('click', () => {
        action.value = 'add';
        label.innerHTML = "Add Peminjaman"
        clear();
        $('#modal').modal('show');
    });

    $("#jsGrid").jsGrid({
        width: "100%",
        pageSize: 15,
        paging: true,
        autoload: true,

        controller: {
            loadData: function() {
                let d =  $.ajax({
                    url: "<?php echo $this->config->config['base_url'] . 'peminjaman/list' ?>",
                    type: "POST",
                    dataType: "json",
                    xhrFields: { //send session
                        withCredentials: true
                    },
                });
                return d;
            }
        },

        editItem: function(e) {
            id.value = e.id;
            action.value = 'edit'
            label.innerHTML = "Edit Peminjaman"
            id_peminjaman.value = e.kode_penerbit;
            tanggal_pinjam.value = e.tanggal_pinjam;
            tanggal_kembali.value = e.tanggal_kembali;

            Array.prototype.forEach.call(mahasiswa.children, (el) => {
                if (el.value == e.mahasiswa) {
                    el.setAttribute('selected', true);
                } else
                    el.setAttribute('selected', false);
                    $('select').selectpicker('refresh')
            });

            Array.prototype.forEach.call(buku.children, (el) => {
                if (el.value == e.buku) {
                    el.setAttribute('selected', true);
                } else
                    el.setAttribute('selected', false);
                    $('select').selectpicker('refresh')
            });
            $('#modal').modal('show');
        },

        sorting: true,

        deleteItem: function(e) {
            let res = confirm("Are you sure to delete this value?");
            if (res) {
                window.location.href = "<?php echo $this->config->config['base_url'] . 'peminjaman/delete?id=' ?>" + e.id
            }
        },

        fields: [{
                name: "id_peminjaman",
                type: "text",
                width: 150,
                title: "ID Peminjaman",
            },
            {
                name: "mahasiswa",
                type: "text",
                width: 100,
                title: "Mahasiswa"
            },
            {
                name: "buku",
                type: "text",
                width: 100,
                title: "Buku"
            },
            {
                name: "tanggal_pinjam",
                type: "text",
                width: 100,
                title: "Tanggal Peminjaman"
            },
            {
                name: "tanggal_kembali",
                type: "text",
                width: 100,
                title: "Tanggal Kembali"
            },
            {
                type: "control"
            },
            {
                name: 'id',
                type: 'number',
                visible: false
            }
        ]
    });
</script>