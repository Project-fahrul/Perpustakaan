<div>
    <button class="btn btn-primary" id="add" role="button">Tambah Mahasiswa</button>
</div>
<!-- bootstrap modal -->
<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="label">Tambah Mahasiswa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="<?php echo $this->config->config['base_url'] . 'mahasiswa' ?>">
                    <input type="hidden" id="act" name="action" value="add">
                    <input type="hidden" id="id_modal" name="id" value="add">
                    <div class="form-group">
                        <label for="fullname">Full Name</label>
                        <input type="text" class="form-control" id="fullname" placeholder="Full Name" name="name">
                    </div>
                    <div class="form-group">
                        <label for="nim">NIM</label>
                        <input type="text" class="form-control" id="nim" placeholder="NIM" name="nim">
                    </div>
                    <div class="form-row">
                        <div class="col">
                            <label for="born">Tanggal Lahir</label>
                            <input type="date" id="born" class="form-control" placeholder="Tanggal Lahir" name="born">
                        </div>
                        <div class="col">
                            <label for="email">Email</label>
                            <input type="email" id="email" class="form-control" placeholder="Email" name="email">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col">
                            <label for="kelas">Kelas</label>
                            <input type="text" id="kelas" class="form-control" placeholder="Kelas" name="kelas">
                        </div>
                        <div class="col">
                            <label for="prodi">Prodi</label>
                            <input type="text" id="prodi" class="form-control" placeholder="Prodi" name="prodi">
                        </div>
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
    let fullname = document.getElementById('fullname'),
        nim = document.getElementById('nim'),
        born = document.getElementById('born'),
        email = document.getElementById('email'),
        kelas = document.getElementById('kelas'),
        prodi = document.getElementById('prodi'),
        label = document.getElementById('label'),
        id = document.getElementById('id_modal'),
        action = document.getElementById('act');

    clear = () => {
        fullname.value = null;
        nim.value = null;
        born.value = null;
        email.value = null;
        kelas.value = null;
        prodi.value = null;
    }

    document.getElementById('add').addEventListener('click', () => {
        action.value = 'add';
        label.innerHTML = "Add Mahasiswa"
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
                    url: "<?php echo $this->config->config['base_url'] . 'mahasiswa/list' ?>",
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
            label.innerHTML = "Edit Mahasiswa"
            fullname.value = e.fullname;
            nim.value = e.nim;
            born.value = e.born;
            email.value = e.email;
            kelas.value = e.kelas;
            prodi.value = e.prodi;
            $('#modal').modal('show');
        },

        sorting: true,

        deleteItem: function(e) {
            let res = confirm("Are you sure to delete this value?");
            if (res) {
                window.location.href = "<?php echo $this->config->config['base_url'] . 'mahasiswa/delete?id=' ?>" + e.id
            }
        },

        fields: [{
                name: "fullname",
                type: "text",
                width: 150,
                title: "Nama Mahasiswa",
            },
            {
                name: "nim",
                type: "text",
                width: 100,
                title: "NIM"
            },
            {
                name: "email",
                type: "text",
                width: 150,
                title: "Email"
            },
            {
                name: "kelas",
                type: "text",
                width: 60,
                title: 'Kelas'
            },
            {
                name: "prodi",
                type: "text",
                title: "Prodi"
            },
            {
                name: "born",
                type: "text",
                title: "Tgl. Lahir"
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