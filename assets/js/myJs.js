$.aboyAJAX = function(settings){
settings.beforeSend = function(){
	alert("before send");
}
settings.success = function(obj) {
	alert("received"); settings.success
}
 $.ajax(settings)
}
var server = "http://rojan.robreyes.xyz/php/"
//var server = "//localhost/macapp/php/"
function getAge(dateString) {
    var today = new Date();
    var birthDate = new Date(dateString);
    var age = today.getFullYear() - birthDate.getFullYear();
    var m = today.getMonth() - birthDate.getMonth();
    if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) 
    {
        age--;
    }

    return age;
}
function isNull(data,total_grade){
	var x = data
	if((!($.isNumeric(total_grade)))){
		return 'N/A';
	}
	if(x=="null" || x==null ) {
		return 'N/A'
	}else{
		return x
	}

}
function adminValidate(callback){
	var res;
	$.ajax({
		url:server+'validate.php',
		data:{request:'admin'},
		dataType:'JSON',
		type:'POST',
		success:function(data){
			res= data
			callback(res)
			
		}
	})
}
$(".modal-transparent").on('show.bs.modal', function () {
  setTimeout( function() {
    $(".modal-backdrop").addClass("modal-backdrop-transparent");
  }, 0);
});
$(".modal-transparent").on('hidden.bs.modal', function () {
  $(".modal-backdrop").addClass("modal-backdrop-transparent");
});

$(".modal-fullscreen").on('show.bs.modal', function () {
  setTimeout( function() {
    $(".modal-backdrop").addClass("modal-backdrop-fullscreen");
  }, 0);
});
$(".modal-fullscreen").on('hidden.bs.modal', function () {
  $(".modal-backdrop").addClass("modal-backdrop-fullscreen");
});

function test(){
	adminValidate(function(d){
		console.log( d)
	})
}

function clearLocalVariables(){
	localStorage.removeItem('information')
}

$('#btnChangePass').click(function(){
	username = JSON.parse(localStorage.getItem('information'))[0].USERNAME
	oldpass=$('#password').val()
	newpass=$('#newpass2').val()
	newpass2=$('#password2').val()
	if(newpass!=newpass2){
		alert('Password must match');
		$('#newpass2').parent().addClass('has-error')
		$('#newpass').parent().addClass('has-error')
	}else if(oldpass=="" || newpass2 =="" || newpass==""){
		alert('Please fill all')

	}else{
		$.ajax({
			url:server+'accounts.php',
			data:{request:'change_pass',username:username,oldpass:oldpass,newpass:newpass,newpass2:newpass2},
			dataType:'JSON',
			type:'POST',
			success:function(data){
				if(data[0].MSG=='PASSWORD CHANGE SUCCESSFUL'){
					alert(data[0].MSG)
					location.reload()
				}else{
					alert(data[0].MSG)
				}
			}
		})
	}
	
})
$('#btnLogOut').click(function(){
	$.ajax({
		url:server+'logout.php',
		success:function(){
			clearLocalVariables()
			location.href='../index.html'
		}
	})
})

function isLoggedIn(){
	url = window.location.pathname
	username = localStorage.getItem('information')
	//if url has admin,teacher,student and no username
	if(!(url.indexOf('admin') ==-1 || url.indexOf('teacher') ==-1 || url.indexOf('student')==-1)) {
		if( username ==null){
			location.href='../index.html'
			return false
		}
		return true
	}
}
$(function(){
	$.ajax({
		url:server+'accounts.php',
		dataType:'JSON',
		data:{request:'validate'},
		type:'POST',
		success:function(data){
			if(data==null){
			}else if(data[0].MSG=="NOT AUTHORIZED"){
				console.log(data[0].MSG)
				clearLocalVariables()
			}
		}
	})
	isLoggedIn()
    FastClick.attach(document.body);

})

