<div>
    <button class="btn btn-primary" id="add" role="button">Tambah Penerbit</button>
</div>
<!-- bootstrap modal -->
<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="label">Tambah Penerbit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="<?php echo $this->config->config['base_url'] . 'penerbit' ?>">
                    <input type="hidden" id="act" name="action" value="add">
                    <input type="hidden" id="id_modal" name="id" value="add">
                    <div class="form-group">
                        <label for="kode">Kode Penerbit</label>
                        <input type="text" class="form-control" id="kode" placeholder="Kode Penerbit" name="kode">
                    </div>
                    <div class="form-group">
                        <label for="penerbit">Penerbit</label>
                        <input type="text" class="form-control" id="penerbit" placeholder="Penerbit" name="penerbit">
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
    let kode = document.getElementById('kode'),
        penerbit = document.getElementById('penerbit'),
        label = document.getElementById('label'),
        id = document.getElementById('id_modal'),
        action = document.getElementById('act');

    clear = () => {
        penerbit.value = null;
        kode.value = null;
    }

    document.getElementById('add').addEventListener('click', () => {
        action.value = 'add';
        label.innerHTML = "Add Penerbit"
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
                    url: "<?php echo $this->config->config['base_url'] . 'penerbit/list' ?>",
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
            label.innerHTML = "Edit Penerbit"
            kode.value = e.kode_penerbit;
            penerbit.value = e.penerbit_buku;
            $('#modal').modal('show');
        },

        sorting: true,

        deleteItem: function(e) {
            let res = confirm("Are you sure to delete this value?");
            if (res) {
                window.location.href = "<?php echo $this->config->config['base_url'] . 'penerbit/delete?id=' ?>" + e.id
            }
        },

        fields: [{
                name: "kode_penerbit",
                type: "text",
                width: 150,
                title: "Kode Penerbit",
            },
            {
                name: "penerbit_buku",
                type: "text",
                width: 100,
                title: "Penerbit Buku"
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