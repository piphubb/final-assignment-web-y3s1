<?php
    $dashboard="";
    $useractive = "";
    $dept = "active";
?>

@include("admin.header")

<script>

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(function(){

            //alert("test");

            $("#adduser").click(function(){
                $("#modal_adduser").modal("show");
            });

            $("#btn-save").click(function(){

                //var dep = $("#depid").val();
                var title = $("#deptitle").val();
                var less = $('#lesson').val();

                if(title=="" || less==""){
                    alert("Please Input Values");
                }else{

            //alert("add");
                    $.post("/adddepart",{txttitle:title,txtless:less},function (result) {
                        alert(result);
                        window.location.href="dept";
                    });
                }
            });

            //delete
            $('#tbldept').on("click","#del",function(){
                var current_row = $(this).closest("tr");
                var id = current_row.find("td").eq(0).text();
                var con = confirm("Do you want to Delete?");
                //alert(id);
                if(con==true){
                    $.post("/deldepart",{deid:id},function (result) {
                    alert(result);
                    current_row.remove();
                    });
                }
            });

            //edit
            $('#tbldept').on("click","#edit",function(){
                var current_row = $(this).closest("tr");
                var id = current_row.find("td").eq(0).text();
                var tit = current_row.find("td").eq(1).text();
                var less = current_row.find("td").eq(2).text();

                $("#txtdepid").val(id);
                $("#deptitle").val(tit);
                $("#lesson").val(less);
                
                $("#modal_adduser").modal("show");
            });

            //save change
            $('#btn-save-change').click(function(){
                //alert("Upadate");

                var depid = $("#txtdepid").val();
                var title = $("#deptitle").val();
                var less = $("#lesson").val();


                    $.post("/updatedep",{txtdepid:depid,txttitle:title,txtless:less},function (result) {
                    alert(result);
                    window.location.href="dept";
                    });
            });
    });

    // $('#tbldept').on("click","delete",function(){
    //     var current_row = $(this).closest("tr");
    //     var id = current_row.find("td").eq(0).text();
    //     alert(id);
    // });

    //alert("hello")

</script>

<div class="table-responsive" style="padding:10px;">
  <div align="right" style="padding:5px;">
    <a href="#" class="btn app-btn-primary" id="adduser">Add User</a>
  </div>

  <table class="table table-bordered table-hover" id="tbldept">
      <thead class="table-info">
          <tr class="">
              <td>Department ID</td>
              <td>Title</td>
              <td>Shitf</td>
              <td>Action</td>
          </tr>
      </thead>
        @foreach($userdata as $dept)
        <tr>
            <td>
                {{$dept->depid}}
            </td>
            <td>
                {{$dept->title}}
            </td>
            <td>
                {{$dept->lesson}}
            </td>
            <td>
                <a href="#" class="edit" id="edit"><i class="fa fa-edit"></i></a>
                <a href="#" class="delete text-danger" id="del"><i class="fa fa-trash"></i></a>
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
                <h1 class="modal-title fs-5" id="exampleModalLabel">Add New Department</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- add -->
                <form>
                    <input type="hidden" id="txtdepid" disabled>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="depid">Department ID</label>
                            <input type="text" class="form-control" id="depid">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="deptitle">Title</label>
                            <input type="text" class="form-control" id="deptitle">
                        </div>
                    </div><div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="lesson">Lesson</label>
                            <input type="text" class="form-control" id="lesson">
                        </div>
                    </div>
                </form>
                <!-- end -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="btn-save">Save</button>
                <button type="button" class="btn btn-primary" id="btn-save-change">Save changes</button>
            </div>
        </div>
    </div>
</div>

@include("admin.footer")