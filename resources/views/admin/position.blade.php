<?php
    $dashboard="";
    $useractive = "";
    $dept = "";
    $position="active";
    $member="";
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

                //var dep = $("#PostionID").val();
                var title = $("#PositionTitle").val();
                var depa = $('#DepartmentID').val();

                if(title=="" || depa==""){
                    alert("Please Input Values");
                }else{

            //alert("add");
                    $.post("/addposition",{txttitle:title,txtdepa:depa},function (result) {
                        alert(result);
                        window.location.href="position";
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
                    $.post("/delposition",{deid:id},function (result) {
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
                var depa = current_row.find("td").eq(2).text();

                $("#txtPostionID").val(id);
                $("#PositionTitle").val(tit);
                $("#DepartmentID").val(depa);
                
                $("#modal_adduser").modal("show");
            });

            //save change
            $('#btn-save-change').click(function(){
                //alert("Upadate");

                var PostionID = $("#txtPostionID").val();
                var title = $("#PositionTitle").val();
                var depa = $("#DepartmentID").val();


                    $.post("/updateposition",{txtPostionID:PostionID,txttitle:title,txtdepa:depa},function (result) {
                    alert(result);
                    window.location.href="position";
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
<p></p>

<div class="row">
    <div class="col-md-4">
        <input type="text" class="form-control" id="validationCustom05" placeholder="Search" style="margin: 20px 1px 10px 10px;">
    </div>
    <div class="col-md-4 ml-auto">
        <a href="#" class="btn app-btn-primary bg-danger" id="validationCustom05" style="margin: 20px 1px 10px 10px;">Search</a>
    </div>
</div>

<div class="table-responsive" style="padding:5px;">
  <div align="right" style="padding:5px;">
    <a href="#" class="btn app-btn-primary" id="adduser">Add User</a>
</div>

  <table class="table table-bordered table-hover" id="tbldept">
      <thead class="table-info">
          <tr class="">
              <td>positionid</td>
              <td>position_title</td>
              <td>department_id</td>
              <td>Action</td>
          </tr>
      </thead>
        @foreach($userdata as $post)
        <tr>
            <td>
                {{$post->positionid}}
            </td>
            <td>
                {{$post->position_title}}
            </td>
            <td>
                {{$post->department_id}}
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
                    <input type="hidden" id="txtPostionID">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="PostionID">Postion ID</label>
                            <input type="text" class="form-control" id="PostionID">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="PositionTitle">Position title</label>
                            <input type="text" class="form-control" id="PositionTitle">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="PositionTitle">Department ID</label>
                            <input type="text" class="form-control" id="DepartmentID">
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