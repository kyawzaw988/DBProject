$(document).ready(function() {
  $('.login').validate({
    rules:{
      username:{
        required:true
      },
      password:{
        required:true
      }
    },
    messages:{
      username: 'A username is required',
      password: 'A password is required',

    },
    errorClass: 'is-invalid text-danger',
    submitHandler: function(form){
      form.submit();
    }
}); 
$('.register').validate({
  rules: {
      fname: {
          required:true
      },
      lname: {
          required:true
      },
      username: {
          required:true
      },
      password: {
          required:true,
          minlength: 6
      }
  },
  messages: {
      fname: 'A first name is required',
      lname: 'A last name is required',
      username: 'A username is required',
      password: {
          required: 'A password is required',
          minlength: jQuery.validator.format('At least {0} characters required!')
      }
  },
  errorClass: 'is-invalid text-danger',
  submitHandler: function(form) {
      form.submit();
  }
});

  $('.datatable').DataTable({
    ajax: './includes/route.php?type=get',
    columns:[
      {data: 'id'},
      {data: 'fname'},
      {data: 'lname'},
      {data: 'phone'},
      {data: 'id',
        fnCreatedCell: function(td, id){
          $(td).html('<div class="text-right"><a href ="/DBProject/update.php?id=' +id+'" title="Edit this record">Update</a> | <a href ="/DBProject/delete.php?id=' +id+'" class="text-danger" onClick="return confirm(\'Are you sure you want to delete this record?\');"title="Delete this record">Delete</a> </div>');
        }
    }    
    ],
    columnDefs: [{
      target: [4],
      orderable: false
    }]
  });

      $('.users').DataTable({
        ajax: './includes/route.php?type=getUsers',
        columns: [
            { data: 'id'},
            { data: 'active'},
            { data: 'username'},
            { data: 'fname'},
            { data: 'lname'},
            { data: 'id',
                fnCreatedCell: function (td, id) {
                    $(td).html('<div class="text-right"><a href="/DBProject/updateUser.php?id='+id+'" title="Edit this record">Update</a> | <a href="/DBProject/deleteUser.php?id='+id+'" class="text-danger" title="Delete this record" onClick="return confirm(\'Are you sure you want to delete this record?\');">Delete</a></div>');
                }
            }
        ],
        columnDefs: [ {
            targets: [5],
            orderable: false
        }]
    });


  $('.phone').mask('000-000-0000');

  $('.form').validate({
      rules:{
        fname:{
          required:true
        },
        lname:{
          required:true
        },
        phone:{
          required:true,
          minlength:12
        }
      },
      messages:{
        fname: 'A first name is required',
        lname: 'A last name is required',
        phone: {
          required:'Phone number is required',
          minlength: jQuery.validator.format('At least {0} characters required!')
        }

      },
      errorClass: 'is-invalid text-danger',
      submitHandler: function(form){
        form.submit();
      }
  }); 
});
//let table = new DataTable('.datatable');
