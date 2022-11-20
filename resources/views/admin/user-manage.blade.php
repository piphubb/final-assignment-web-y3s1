<?php
    $dashboard="";
    $useractive = "active";
    $dept = "";
    $position="";
?>

@include("admin.header")

<script>
    
    $(function(){
        //alert("test");
        $("#adduser").click(function(){
            $("#modal_adduser").modal("show");
        });
    });
    $('#tbluser').on("click","delete",function(){
        var current_row = $(this).closest("tr");
        var id = current_row.find("td").eq(0).text();
        alert(id);
    });

</script>

<div class="table-responsive" style="padding:10px;">
  <div align="right" style="padding:5px;">
    <a href="#" class="btn app-btn-primary" id="adduser">Add User</a>
  </div>

  <table class="table table-bordered table-hover" id="tbluser">
  <tr class="table-primary">
      <td>User ID</td>
      <td>Username</td>
      <td>Created Date</td>
      <td>Action</td>
  </tr>
    @foreach($userdata as $obj)
    <tr>
        <td>
            {{$obj->userid}}
        </td>
        <td>
            {{$obj->username}}
        </td>
        <td>{{$obj->create_date}}</td>
        <td>
            <a href="#" class="edit"><i class="fa fa-edit"></i></a>
            <a href="#" class="delete"><i class="fa fa-trash" style="color:red"></i></a>
        </td>
    </tr>
    @endforeach
  </table>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="modal_adduser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <!-- add -->
          
          <!-- end -->
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>

@include("admin.footer")
