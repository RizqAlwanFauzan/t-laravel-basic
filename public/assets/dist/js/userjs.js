$(function () {
    setTimeout(function () {
        $('.alert').alert('close');
    }, 3000);

    $(document).on('click', 'button[type="reset"], button[data-bs-toggle="modal"]', function () {
        event.preventDefault()
        $('.is-invalid').removeClass('is-invalid');
        $('.alert').alert('close');
        $('input[type="text"], input[type="date"], select, textarea').val('');
    });

    const table = $('#table-user').DataTable({
        scrollX: true,
        // dom: 'lBftrip',
        buttons: ['copy', 'excel', 'pdf', 'print'],
    });

    table.buttons().container().appendTo('#table-user_wrapper .col-md-6:eq(0)');

    if ($('#proses').val() == 'tambah') {
        $('#tambahModal').modal('show');
    }

    if ($('#proses').val() == 'ubah') {
        $('#ubahModal').modal('show');
    }

    $(document).on('click', '.btn-ubah', function () {
        const id_user = $(this).data('id_user');
        const nama = $(this).data('nama');
        const tgl_lahir = $(this).data('tgl_lahir');
        const jekel = $(this).data('jekel');
        const alamat = $(this).data('alamat');

        $('#form2-id').val(id_user);
        $('#form2-1').val(nama);
        $('#form2-2').val(tgl_lahir);
        $('#form2-3').val(jekel);
        $('#form2-4').val(alamat);
    });

    $(document).on('click', '.btn-hapus', function () {
        const id_user = $(this).data('id_user');

        $('#form3-id').val(id_user);
    });
});



