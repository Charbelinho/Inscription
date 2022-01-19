<script type="text/javascript">
      $(document).ready(function() {
    $(".add").click(function() {  
        var ligne = "<tr><td style='padding:5px;'><input type='text' class='form-control m-md-auto' id='des' name='desc[]' required='required'></td><td><select style='width:100%;' name='fam[]'  id='fam' class='form-control m-md-auto select2 fam' required><option value=''></option><?php foreach($fam as $fa){ ?><option value='<?= $fa['id'] ?>'><?= $fa['libelle']?></option><?php } ?></select></td><td style='padding:5px;'><select style='width:100%;' name='cat[]' required='required' id='cat' class='form-control m-md-auto select2 cat selectpicker'><option value=''></option><option value='vivre'>Vivre</option> <option value='non-vivre'>Non Vivre</option></select></td><td style='text-align:center'><button style='width:100%;' class='btnDelete btn btn-danger'><i class='fa fa-trash' aria-hidden='true'></i></button></td></tr>";
        $("table.test").append(ligne);  
        $('.select2').select2();      
    });
   
});
</script>	
<script type="text/javascript">
$(document).ready(function() {
    $('.select2').select2(); 
});
</script>
<script type="text/javascript">
$(document).ready(function(){
 $("#tab").on('click','.btnDelete',function(){
       $(this).closest('tr').remove();
     });

}); 			
    </script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>