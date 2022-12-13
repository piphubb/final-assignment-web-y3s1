<?php
    $dashboard="";
    $useractive = "active";
    $dept = "";
    $position="";
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

        //save
        $("#btnsave").click(function(){

        //var dep = $("#depid").val();
        var user = $("#UserName").val();
        var passwd = $('#Passwd').val();

        if(user=="" || passwd==""){
            alert("Please Input Values");
        }else{

        //alert("add");
            $.post("/adduser",{txtusername:user,txtpasswd:passwd},function (result) {
                alert(result);
                window.location.href="user";
            });
        }
        });

        //delete
        $('#tbluser').on('click',"#delete",function(){
                var current_row = $(this).closest("tr");
                var id = current_row.find("td").eq(0).text();
                var con = confirm("Do you want to Delete?");
                //alert(id);
                if(con==true){
                  //alert('User has been Delete')
                    $.post("/deluser",{userid:id},function (result) {
                    alert(result);
                    current_row.remove();
                    });
                }
            });

            //edit
            $('#tbluser').on("click","#edit",function(){
                var current_row = $(this).closest("tr");
                var id = current_row.find("td").eq(0).text();
                var tit = current_row.find("td").eq(1).text();
                var pass = current_row.find("td").eq(2).text();

                $("#txtdepid").val(id);
                $("#UserName").val(tit);
                $("#Passwd").val(pass);
                
                $("#modal_adduser").modal("show");
            });

            //save change
            $('#btn-save-change').click(function(){
                //alert("Upadate");

                var userid = $("#txtdepid").val();
                var title = $("#UserName").val();
                var less = $("#Passwd").val();


                    $.post("/updateuser",{txtdepid:userid,txttitle:title,txtless:less},function (result) {
                    alert(result);
                    window.location.href="user";
                    });
            });
    });

    // $('#tbluser').on("click","delete",function(){
    //     var current_row = $(this).closest("tr");
    //     var id = current_row.find("td").eq(0).text();
    //     alert(id);
    // });

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
            <a href="#" class="edit" id="edit"><i class="fa fa-edit"></i></a>
            <a href="#" class="delete" id="delete"><i class="fa fa-trash" style="color:red"></i></a>
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
                <form>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="depid">Department ID</label>
                            <input type="text" class="form-control" id="depid" disabled>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="UserName">UserName</label>
                            <input type="text" class="form-control" id="UserName">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="Passwd">PassWord</label>
                            <input type="text" class="form-control" id="Passwd">
                        </div>
                    </div>
                </form>
          <!-- end -->
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" id="btnsave">Save</button>
          <button type="button" class="btn btn-primary" id="btn-save-change">Save changes</button>
        </div>
      </div>
    </div>
  </div>
  <input type="hidden" id="txtdepid" disabled>
@include("admin.footer")
