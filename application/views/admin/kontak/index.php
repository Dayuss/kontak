<div class="x_content">
  <a href="#form" class="btn btn-primary" data-toggle="modal" onclick="submit('tambah')"><i class="fa fa-plus"></i> tambah</a>
  <table id="datatable" class="table table-striped table-bordered">
    <thead>
      <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Email</th>
        <th>Pesan</th>
        <th>aksi</th>
      </tr>
    </thead>
    <tbody id="data_kontak"></tbody>
  </table>
</div>
<div class="modal fade" id="form" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="text-center"><?=$title?></h3>
      </div>
      <div class="modal-body">
        <p class="text-center" id="pesan" style="color:red!important;font-weight:600;"></p>
        <div class="form-group">
          <label>Nama</label>
          <input type="text" name="nama_kontak" id="nama_kontak" class="form-control">
          <input type="hidden" name="id_kontak" id="id_kontak" value="">
        </div>
        <div class="form-group">
          <label>Email</label>
          <input type="email" name="email_kontak" id="email_kontak" class="form-control">
        </div>
        <div class="form-group">
          <label>Pesan</label>
          <textarea type="text" name="pesan_kontak" id="pesan_kontak" class="form-control"></textarea>
        </div>
        <div class="form-group">
          <button type="button" class="btn btn-primary" name="btn-tambah" id="btn-tambah" onclick="tambahData()">Tambah</button>
          <button type="button" class="btn btn-primary" name="btn-edit" id="btn-edit" onclick="editData()">Edit</button>
          <button type="reset" data-dismiss="modal" class="btn btn-default">Batal</button>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript" charset="utf-8" async defer>
  ambil_data();
  function submit(param){
    if(param == 'tambah'){
      $("#btn-tambah").show();
      $("#btn-edit").hide();
    }else{
      $("#btn-edit").show();
      $("#btn-tambah").hide();

      $.ajax({
        url:"<?=base_url('kontak/ambil_id')?>",
        dataType:"JSON",
        type:"POST",
        data:"id_kontak="+param,
        success:function(hasil){
          if(param != 'tambah'){
            $("#id_kontak").val(hasil[0].id_kontak);
            $("#nama_kontak").val(hasil[0].nama_kontak);
            $("#email_kontak").val(hasil[0].email_kontak);
            $("#pesan_kontak").val(hasil[0].pesan_kontak);
          }else if(param == ''){
            $("#nama_kontak").val(hasil[0].nama_kontak);
            $("#email_kontak").val(hasil[0].email_kontak);
            $("#pesan_kontak").val(hasil[0].pesan_kontak);
          }
        }
      });
    }
  }
  function ambil_data(){
    $.ajax({
      url:"<?=base_url('kontak/ambil_data')?>",
      type:"POST",
      dataType:"JSON",
      success:function(data){
        var tampung = "";
        var i = 0;
        var no = 1;
        for(i=0;i<data.length;i++){
          tampung +=
          "<tr>"+
            "<td>"+no+"</td>"+
            "<td>"+data[i].nama_kontak+"</td>"+
            "<td>"+data[i].email_kontak+"</td>"+
            "<td>"+data[i].pesan_kontak+"</td>"+
            "<td>"+
              "<a href='#form' data-toggle='modal' class='btn btn-info' onclick='submit("+data[i].id_kontak+")'>Edit</a>"+
              "<a class='btn btn-danger' onclick='hapus("+data[i].id_kontak+")'>Hapus</a>"+
            "</td>"+
          "</tr>";
          no++;
        }
        $("#data_kontak").html(tampung);
      }
    });
  }

  function tambahData(){
    var kontak = {
      "nama_kontak"  : $("#nama_kontak").val(),
      "email_kontak" : $("#email_kontak").val(),
      "pesan_kontak" : $("#pesan_kontak").val(),
    }
    $.ajax({
      url:"<?=base_url('kontak/tambah_data')?>",
      type:"POST",
      dataType:"JSON",
      data:kontak,
      success:function(hasil){
        $("#pesan").html(hasil.pesan);
        if(hasil.pesan == ""){
          $("#form").modal('hide');
          alert('data berhasil diinput');
          location.reload();
          ambil_data();
        }
      }
    });
  }

  function editData(){
    var kontak = {
      "id_kontak"  : $("#id_kontak").val(),
      "nama_kontak"  : $("#nama_kontak").val(),
      "email_kontak" : $("#email_kontak").val(),
      "pesan_kontak" : $("#pesan_kontak").val(),
    }
    $.ajax({
      url:"<?=base_url('kontak/edit_data')?>",
      type:"POST",
      dataType:"JSON",
      data:kontak,
      success:function(hasil){
        $("#pesan").html(hasil.pesan);
        if(hasil.pesan == ""){
          $("#form").modal('hide');
          alert('data berhasil diupdate');
          location.reload();
          ambil_data();
        }
      }
    });
  }

  function hapus(id_kontak){
    var tanya = confirm('anda yakin akan menghapus data ini ??');
    if(tanya){
      $.ajax({
        url:"<?=base_url('kontak/hapus')?>",
        data:"id_kontak="+id_kontak,
        dataType:"JSON",
        type:"POST",
        success:function(){
          location.reload();
          ambil_data();
        }
      });
    }
  }
</script>