<div class="section container row">
    
</div>

<script>
$(document).ready(function(){
	
$("#selectsector").change(function () {  
//console.log($("#selectsector").val());
var sede = $("#selectsector").val() ;
location.replace('login/'+sede+'/cambiosede');
});	

});
</script>