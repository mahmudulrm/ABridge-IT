<script src='js/jquery.min.js'></script>	

 <script>
	 $(function() {
            $(".del_button").click(function() {
                var del_id = $(this).attr("id");
                var info = 'id=' + del_id;
                    $.ajax({
                        type : "POST",
                        url : "include/delete.php", //URL to the delete php script
                        data : info,
                        success : function() {			
                        }
                    }); 
					$(this).attr('style', 'display: none');
                return false;
            });
        });
	
 </script>	

 
<?php	
include 'admin/db_connect.php';
$results = db_query("SELECT * FROM `login` ORDER BY `login`.`u_id` ASC");
while($row = $results->fetch_assoc())
{
  echo '<a href="#" class="del_button" id="'.$row["u_id"].'">';
  echo '<img src="images/icon_del.gif" border="0" />';
  echo $row["last_name"].'</a>';
 ;
}

