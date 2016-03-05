<?php
$where = isset($_POST['selectCatExperienceList'])? $_POST['selectCatExperienceList']:'engineering';
?>
<div class="col s12 center">
  	<h3 class="black-text">LIST OF EXPERIENCE</h3>
</div>
<div class="container">
	<form action="#" method="post" enctype="multipart/form-data">
		<div class="input-field col s12 l4 m6 offset-l4 offset-m3 center">
		    <select id="selectCatExperienceList" name="selectCatExperienceList">
		        <option value="engineering">Engineering</option>
		        <option value="civil">Civil Construction</option>
		    </select>
		</div>
	</form>
</div>
<div class="container">
	<div class="col s12">
		<table class="striped bordered responsive-table">
			<thead>
				<tr class="hide-on-small-only">
					<th width="05%">Date</th>
					<th width="30%">Name</th>
					<th width="15%">Category</th>
					<th width="15%">Location</th>
					<th width="15%">Product</th>
					<th width="20%">End User</th>
				</tr>
				<tr class="hide-on-med-and-up">
					<th>Date</th>
					<th>Name</th>
					<th>Location</th>
					<th>Client</th>
				</tr>
			</thead>
			<tbody>
				<?php
					$projListQry = "SELECT 
                    project.idproject as idproject,
                    project.name as name,
                    project.category as category,
                    project.product as product,
                    project.location as location,
                    project.date as date,
                    client.name as clientName
                    FROM 
                        project,
                        client
                    WHERE project.idclient = client.idclient 
                    AND category = '".$where."'
                    ORDER BY date DESC";

				    if($resultProjList = mysqli_query($conn, $projListQry) or die("Query failed :".mysqli_error($conn))){
				        if(mysqli_num_rows($resultProjList) > 0){
				            while($rowProjList = mysqli_fetch_array($resultProjList)){
					            $idProject         	= $rowProjList['idproject'];
					            $nameProjList       = $rowProjList['name'];
					            $nameClientProjList	= $rowProjList['clientName'];
					            $locationProjList   = $rowProjList['location'];
					            $dateProjList  		= $rowProjList['date'];
					            $catProjList  		= $rowProjList['category'];
					            $prodProjList  		= $rowProjList['product'];
					            ?>
									<tr>
										<td>
											<?php echo $dateProjList;?>
										</td>
										<td>
											<?php echo $nameProjList;?>
										</td>
										<td>
											<?php echo $catProjList;?>
										</td>
										<td>
											<?php echo $locationProjList;?>
										</td>
										<td>
											<?php echo $prodProjList;?>
										</td>
										<td>
											<?php echo $nameClientProjList;?>
										</td>
									</tr>
					            <?php
				            }
				        }
				    }
				?>
			</tbody>
		</table>
	</div>
</div>