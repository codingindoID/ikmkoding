<!-- jQuery 3 -->
<script src="<?php echo base_url().'assets/'?>bower_components/jquery/dist/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?php echo base_url().'assets/'?>bower_components/jquery-ui/jquery-ui.min.js"></script>

<!-- DataTables -->
<script src="<?php echo base_url().'assets/'?>bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url().'assets/'?>bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url().'assets/'?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<!-- datepicker -->
<script src="<?php echo base_url().'assets/'?>bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- Slimscroll -->
<script src="<?php echo base_url().'assets/'?>bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?php echo base_url().'assets/'?>bower_components/fastclick/lib/fastclick.js"></script>

<!-- Select2 -->
<script src="<?php echo base_url().'assets/'?>bower_components/select2/dist/js/select2.full.min.js"></script>

<!-- AdminLTE App -->
<script src="<?php echo base_url().'assets/'?>dist/js/adminlte.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?php echo base_url().'assets/'?>dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url().'assets/'?>dist/js/demo.js"></script>

<!-- Select2 -->
<script src="<?php echo base_url().'assets/'?>bower_components/select2/dist/js/select2.full.min.js"></script>

<!-- button -->
<script src="<?php echo base_url().'assets/bt_datatable/'?>dataTables.buttons.min.js"></script>
<script src="<?php echo base_url().'assets/bt_datatable/'?>buttons.flash.min.js"></script>
<script src="<?php echo base_url().'assets/bt_datatable/'?>jszip.min.js"></script>
<script src="<?php echo base_url().'assets/bt_datatable/'?>pdfmake.min.js"></script>
<script src="<?php echo base_url().'assets/bt_datatable/'?>vfs_fonts.js"></script>
<script src="<?php echo base_url().'assets/bt_datatable/'?>buttons.html5.min.js"></script>
<script src="<?php echo base_url().'assets/bt_datatable/'?>buttons.print.min.js"></script>


</body>
</html>
<!-- page script -->
<script>
  $(function () {
    $('.select2').select2()
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
    $('#example3').DataTable({
      dom: 'Bfrtip',
      scrollY:550,
      columnDefs: [
      {
        targets: 2,
        className: 'dt-body-center'
      },
      {
        targets: 3,
        className: 'dt-body-center'
      },
      {
        targets: 4,
        className: 'dt-body-center'
      }
      ],
      buttons: [
      {
        extend: 'excel',
        title: '<?php echo $sub ?>',
        exportOptions:{
          columns:[0,1,2,3,4,5,6,7,8]
        },
      },
      {
        extend: 'print',
        exportOptions:{
          columns:[0,1,2,3,4,5,6,7,8]
        },
        title: function() {
          return "<div style='font-size: 20px;'><Strong><center><?php echo $sub ?></center></strong></div>";
        } ,
        customize: function ( win ) {
          $(win.document.body)
          .css( 'font-size', '10pt' );
          $(win.document.body).find( 'table' )
          .addClass( 'compact' )
          .css( 'font-size', 'inherit' );
        }
      }/*,
      {
        extend: 'pdf',
        exportOptions:{
          columns:[0,1,2,3,4,5,6,7]
        },
        download : 'open',
        title: "<?php echo $sub ?>" ,
        pageSize : 'legal',
        orientation : 'landscape',
        customize: function (doc) {
          doc.content[1].table.widths = 
          Array(doc.content[1].table.body[0].length + 1).join('*').split('');
        }
      }*/
      ]
    })
    $('#tb4').DataTable({
      dom: 'Bfrtip',
      scrollY:550,
      columnDefs: [
      {
        targets: 2,
        className: 'dt-body-center'
      },
      {
        targets: 3,
        className: 'dt-body-center'
      },
      {
        targets: 4,
        className: 'dt-body-center'
      },
      {
        targets: 5,
        className: 'dt-body-center'
      },
      {
        targets: 6,
        className: 'dt-body-center'
      },
      {
        targets: 7,
        className: 'dt-body-center'
      }
      ],
      buttons: [
      {
        extend: 'excel',
        title: '<?php echo $sub ?>',
        exportOptions:{
          columns:[0,2,3,4,5,6,7,8,9]
        },
      }/*,
      {
        extend: 'print',
        exportOptions:{
          columns:[0,2,3,4,5,6,7]
        },
        title: function() {
          return "<div style='font-size: 20px;'><Strong><center><?php echo $sub ?></center></strong></div>";
        } ,
        customize: function ( win ) {
          $(win.document.body)
          .css( 'font-size', '10pt' );
          $(win.document.body).find( 'table' )
          .addClass( 'compact' )
          .css( 'font-size', 'inherit' );
        }
      },
      {
        extend: 'pdf',
        exportOptions:{
          columns:[0,2,3,4,5,6,7]
        },
        download : 'open',
        title: "<?php echo $sub ?>" ,
        pageSize : 'legal',
        orientation : 'landscape',
        customize: function (doc) {
          doc.content[1].table.widths = 
          Array(doc.content[1].table.body[0].length + 1).join('*').split('');
        }
      }*/
      ]
    })
    
    
    //Date picker
    $('#datepicker').datepicker({
      autoclose: true,
      format: 'dd-mm-yyyy'
    })

     //Date picker
     $('#dateend').datepicker({
      autoclose: true,
      format: 'dd-mm-yyyy'
    })


   })
 </script>

 <script type="text/javascript">
  function getitem(){
   var a = document.getElementById("status_kirim").value;
   var b = document.getElementById("row_ket");
   if(a=="3"){
    b.hidden=false;
  }else{
   b.hidden=true;
 }
}
</script>