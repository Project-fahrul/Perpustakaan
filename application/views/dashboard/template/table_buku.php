<div>
    <button class="btn btn-primary" id="add" role="button">Tambah Buku</button>
</div>
<!-- bootstrap modal -->
<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="label">Tambah Buku</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="<?php echo $this->config->config['base_url'] . 'buku' ?>">
                    <input type="hidden" id="act" name="action" value="add">
                    <input type="hidden" id="id_modal" name="id" value="add">
                    <div class="form-group">
                        <label for="judul">Judul</label>
                        <input type="text" class="form-control" id="judul" placeholder="Judul" name="judul">
                    </div>
                    <div class="form-group">
                        <label for="pengarang">Pengarang</label>
                        <input type="text" class="form-control" id="pengarang" placeholder="Pengarang" name="pengarang">
                    </div>
                    <div class="form-group">
                        <label for="jumlah">Jumlah</label>
                        <input type="number" class="form-control" id="jumlah" placeholder="Jumlah" name="jumlah">
                    </div>
                    <div class="form-group">
                        <label for="penerbit">Penerbit</label>
                        <select name='penerbit' id="penerbit" class="form-control" aria-label="Default select example" required data-live-search="true">
                            <option selected value="">Pilih Penerbit</option>
                            <?php
                            $penerbit = $this->penerbit_model->get();

                            foreach ($penerbit as $author) :
                            ?>
                                <option data-tokens="<?php echo $author->penerbit_buku ?>" value="<?php echo $author->id ?>"><?php echo $author->penerbit_buku ?></option>
                            <?php endforeach; ?>
                        </select>
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
<script>
    $(document).ready(() => {
        $('#penerbit').selectpicker()
    })
</script>
<div class="mt-3" id="jsGrid"></div>

<script src="<?php echo $this->config->config['base_url']; ?>template/jsgrid/jsgrid.min.js"></script>
<script>
    let judul = document.getElementById('judul'),
        jumlah = document.getElementById('jumlah'),
        pengarang = document.getElementById('pengarang'),
        penerbit = document.getElementById('penerbit'),
        id = document.getElementById('id_modal'),
        action = document.getElementById('act');

    clear = () => {
        judul.value = null;
        jumlah.value = null;
        pengarang.value = null;
        // penerbit.value = null;
    }

    document.getElementById('add').addEventListener('click', () => {
        action.value = 'add';
        label.innerHTML = "Add Buku"
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
                let d = $.ajax({
                    url: "<?php echo $this->config->config['base_url'] . 'buku/list' ?>",
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
            label.innerHTML = "Edit Buku"
            judul.value = e.judul;
            Array.prototype.forEach.call(penerbit.children, (el) => {
                console.log(el.value, e.id, el.value == e.id);
                if (el.value == e.id) {
                    el.setAttribute('selected', true);
                } else
                    el.setAttribute('selected', false);
                    $('#penerbit').selectpicker('refresh')
            });
            jumlah.value = e.jumlah;
            pengarang.value = e.pengarang;
            $('#modal').modal('show');
        },

        sorting: true,

        deleteItem: function(e) {
            let res = confirm("Are you sure to delete this value?");
            if (res) {
                window.location.href = "<?php echo $this->config->config['base_url'] . 'buku/delete?id=' ?>" + e.id
            }
        },

        fields: [{
                name: "judul",
                type: "text",
                width: 150,
                title: "Judul",
            },
            {
                name: "pengarang",
                type: "text",
                width: 100,
                title: "Pengarang"
            },
            {
                name: "penerbit",
                type: "text",
                width: 100,
                title: "Penerbit"
            },
            {
                name: "jumlah",
                type: "text",
                width: 80,
                title: "Jumlah"
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