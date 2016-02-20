<div class="col s12 center">
  	<h3 class="black-text">LIST OF EXPERIENCE</h3>
</div>
<div class="container">
	<div class="col s12">
		<table class="striped bordered responsive-table">
			<thead>
				<tr class="hide-on-small-only">
					<th width="200px">Date</th>
					<th width="400px">Name</th>
					<th width="300px">Location</th>
					<th width="400px">Client</th>
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
                    project.location as location,
                    project.date as date,
                    client.name as clientName
                    FROM 
                        project,
                        client
                    WHERE project.idclient = client.idclient
                    ORDER BY date DESC";

				    if($resultProjList = mysqli_query($conn, $projListQry) or die("Query failed :".mysqli_error($conn))){
				        if(mysqli_num_rows($resultProjList) > 0){
				            while($rowProjList = mysqli_fetch_array($resultProjList)){
					            $idProject         	= $rowProjList['idproject'];
					            $nameProjList       = $rowProjList['name'];
					            $nameClientProjList	= $rowProjList['clientName'];
					            $locationProjList   = $rowProjList['location'];
					            $dateProjList  		= date('j F, Y', strtotime($rowProjList['date']));
					            ?>
									<tr>
										<td>
											<?php echo $dateProjList;?>
										</td>
										<td>
											<?php echo $nameProjList;?>
										</td>
										<td>
											<?php echo $locationProjList;?>
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