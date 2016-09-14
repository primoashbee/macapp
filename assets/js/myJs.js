var server = "//localhost/macapp/php/"
function getAge(dateString) 
{
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

function test(){
	adminValidate(function(d){
		console.log( d)
	})

}