@include('template.header')

<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Supplier</h3>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row mt-3">
            <div class="col-sm-12">
                <button id="tambahdata" class="btn btn-success"><i class="fa fa-plus"></i> Tambah Data</button>
                <button id="refreshdata" class="btn btn-info"><i class="fa fa-refresh"></i> Refresh Data</button>
                <div class="card-box table-responsive mt-3">
                    <table id="list_data" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Supplier</th>
                                <th>Alamat</th>
                                <th>No Telepon</th>
                                <th>#</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@include('template.footer')
</div>
</div>


<div class="modal fade bs-example-modal" id="modalform" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Title</h4>
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal form-label-left">
                    @csrf
                    <div class="form-group row" hidden>
                        <input type="text" id="id" class="form-control">
                    </div>
                    <div class="form-group row">
                        <label>Nama Supplier</label>
                        <input type="text" id="name" class="form-control" placeholder="Nama Supplier">
                    </div>
                    <div class="form-group row">
                        <label>Alamat</label>
                        <input type="text" id="address" class="form-control" placeholder="Alamat">
                    </div>
                    <div class="form-group row">
                        <label>No Telepon</label>
                        <input type="text" id="phone" class="form-control" placeholder="Nomor Telepon">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i>
                    Batal</button>
                <button type="button" class="btn btn-success" id="btnsimpandata"><i class="fa fa-save"></i>
                    Simpan</button>
                <button type="button" class="btn btn-info" id="btnubahdata"><i class="fa fa-edit"></i> Ubah</button>
            </div>
        </div>
    </div>
</div>

<script src="{{ url('/gentelella') }}/vendors/jquery/dist/jquery.min.js"></script>
<script src="{{ url('/gentelella') }}/vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ url('/gentelella') }}/vendors/fastclick/lib/fastclick.js"></script>
<script src="{{ url('/gentelella') }}/vendors/nprogress/nprogress.js"></script>
<script src="{{ url('/gentelella') }}/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="{{ url('/gentelella') }}/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="{{ url('/gentelella') }}/vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="{{ url('/gentelella') }}/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
<script src="{{ url('/gentelella') }}/vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
<script src="{{ url('/gentelella') }}/vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="{{ url('/gentelella') }}/vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="{{ url('/gentelella') }}/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
<script src="{{ url('/gentelella') }}/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
<script src="{{ url('/gentelella') }}/vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="{{ url('/gentelella') }}/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
<script src="{{ url('/gentelella') }}/vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
<script src="{{ url('/gentelella') }}/vendors/jszip/dist/jszip.min.js"></script>
<script src="{{ url('/gentelella') }}/vendors/pdfmake/build/pdfmake.min.js"></script>
<script src="{{ url('/gentelella') }}/vendors/pdfmake/build/vfs_fonts.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script type="text/javascript">
    function clearform() {
        $('#id').val('');
        $('#name').val('');
        $('#address').val('');
        $('#phone').val('');
    }

    $(document).ready(function() {
        clearform();
        var table = $('#list_data').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('supplier.data') }}',
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'address',
                    name: 'address'
                },
                {
                    data: 'phone',
                    name: 'phone'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                }
            ],
            rowCallback: function(row, data, index) {
                var pageInfo = table.page.info();
                $('td:eq(0)', row).html(pageInfo.start + index + 1);
            }
        });

        $('#refreshdata').on('click', function() {
            table.ajax.reload(null, false);
        });

        $('#tambahdata').on('click', function() {
            clearform();
            $('#myModalLabel').html('<i class="fa fa-plus"></i> Tambah Data');
            $('#btnsimpandata').show();
            $('#btnubahdata').hide();
            $('#modalform').modal('show');
        });
    });
</script>
<script src="{{ url('/gentelella') }}/build/js/custom.min.js"></script>

</body>

</html>
