<?php
    $dashboard="";
    $useractive = "";
    $dept = "";
    $position="";
    $member="active";
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

                alert("add success");
                    // $.post("/adddepart",{txttitle:title,txtless:less},function (result) {
                    //     alert(result);
                    //     window.location.href="dept";
                    // });
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
              <td>meberid </td>
              <td>firstname</td>
              <td>lastname</td>
              <td>gender</td>
              <td>username</td>
              <td>password</td>
              <td>departmentid</td>
              <td>positonid</td>
              <td>join_date</td>
              <td>last_login_date</td>
              <td>Action</td>
          </tr>
      </thead>
        <tr>
            <td>
                1
            </td>
            <td>
                ku
            </td>
            <td>
                lin
            </td>
            <td>
                Male
            </td>
            <td>
                kulin
            </td>
            <td>
                123
            </td>
            <td>
                1
            </td>
            <td>
                1
            </td>
            <td>
                28-11-2022
            </td>
            <td>
                28-11-2022
            </td>
            <td>
                <a href="#" class="edit" id="edit"><i class="fa fa-edit"></i></a>
                <a href="#" class="delete text-danger" id="del"><i class="fa fa-trash"></i></a>
            </td>
        </tr>
        <tr>
            <td>
                2
            </td>
            <td>
                ku
            </td>
            <td>
                lin
            </td>
            <td>
                Male
            </td>
            <td>
                kulin
            </td>
            <td>
                123
            </td>
            <td>
                1
            </td>
            <td>
                1
            </td>
            <td>
                28-11-2022
            </td>
            <td>
                28-11-2022
            </td>
            <td>
                <a href="#" class="edit" id="edit"><i class="fa fa-edit"></i></a>
                <a href="#" class="delete text-danger" id="del"><i class="fa fa-trash"></i></a>
            </td>
        </tr>
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
                    <div class="form-row">
                        <div class="form-group col-md-12">
                        <label for="inputEmail4">MemberID</label>
                        <input type="email" class="form-control" id="inputEmail4">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                        <label for="inputEmail4">firstname</label>
                        <input type="email" class="form-control" id="inputEmail4">
                        </div>
                        <div class="form-group col-md-12">
                        <label for="inputPassword4">lastname</label>
                        <input type="text" class="form-control" id="inputPassword4">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputAddress">username</label>
                        <input type="text" class="form-control" id="inputAddress">
                    </div>
                    <div class="form-group">
                        <label for="inputAddress2">password</label>
                        <input type="text" class="form-control" id="inputAddress2">
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                        <label for="inputState">Gender</label>
                        <select id="inputState" class="form-control">
                            <option selected>Choose Gender</option>
                            <option>Male</option>
                            <option>Female</option>
                        </select>
                        </div>
                        <div class="form-group col-md-12">
                        <label for="inputState">Department ID</label>
                        <select id="inputState" class="form-control">
                            <option selected>Choose Department</option>
                            <option>IT</option>
                            <option>English</option>
                        </select>
                        </div>
                        <div class="form-group col-md-12">
                        <label for="inputZip">Join Date</label>
                        <input type="date" class="form-control" id="inputZip">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="gridCheck">
                        <label class="form-check-label" for="gridCheck">
                            Check me out
                        </label>
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