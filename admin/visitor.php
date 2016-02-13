<?php
	$postMessages = isset($postMessages)?$postMessages:'';
	$colorMessages = isset($colorMessages)?$colorMessages:'';
	// ============================== BUTTON DELETE CLICK ==========================================================
	if(isset($_POST['btnDeleteVisitor'])){
		foreach ($_POST['checkboxVisitor'] as $selectedIdVisitor) {
			$delUserQry = "DELETE FROM visitor WHERE idvisitor = '".$selectedIdVisitor."'";

			if (mysqli_query($conn, $delUserQry)) {
			    $postMessages =  "Record deleted successfully";
				$colorMessages = "green-text";
			} else {
			    $postMessages = "Error deleting record: " . mysqli_error($conn);
	        	$colorMessages = "red-text";
			}
		}
	}
?>
<div class="row">
	<div class="col s12 border-bottom grey lighten-2 mb-50">
		<h3 class="left-align">Visitor Messages</h3>
	</div>
	<div class="col s12">
		<form action="#" method="post" enctype="multipart/form-data">
			<div class="col s12 mb-30">
				<a id="delSelectionVisitorButton" href="#modalDelVisitorItems" class="modal-trigger waves-effect waves-light btn red accent-4 disabled"><i class="material-icons left">delete</i>Delete</a>
			</div>
			<table class="highlight responsive-table">
				<thead>
					<tr>
						<td>
							<p>
								<input type="checkbox" id="checkAll" />
								<label for="checkAll"></label>
							</p>
						</td>
						<td>
							Date
						</td>
						<td>
							First Name
						</td>
						<td>
							Last Name
						</td>
						<td>
							Phone
						</td>
						<td>
							Email
						</td>
						<td>
							Message
						</td>
					</tr>
				</thead>
				<tbody>
					<?php
						if($resultVisitorQry = mysqli_query($conn, "SELECT *, DATE_FORMAT(datePost,'%e %b %Y - %H:%i') as datepost FROM visitor")){
							if (mysqli_num_rows($resultVisitorQry) > 0) {
								while ($rowVisitor = mysqli_fetch_array($resultVisitorQry)) {
									$idvisitor         	= $rowVisitor['idvisitor'];
									$dateVisitor       	= $rowVisitor['datepost'];
									$firstNameVisitor  	= $rowVisitor['firstName'];
									$lastNameVisitor   	= $rowVisitor['lastName'];
									$phoneVisitor 		= $rowVisitor['phone'];
									$emailVisitor 		= $rowVisitor['email'];
									$messageVisitor 	= $rowVisitor['message'];
									?>
									<tr>
										<td>
											<p>
												<input name="checkboxVisitor[]" type="checkbox" id="<?php echo $idvisitor; ?>" value="<?php echo $idvisitor; ?>" />
												<label for="<?php echo $idvisitor; ?>"></label>
											</p>
										</td>
										<td>
											<?php echo $dateVisitor; ?>
										</td>
										<td>
											<?php echo $firstNameVisitor; ?>
										</td>
										<td>
											<?php echo $lastNameVisitor; ?>
										</td>
										<td>
											<?php echo $phoneVisitor; ?>
										</td>
										<td>
											<?php echo $emailVisitor; ?>
										</td>
										<td>
											<?php echo $messageVisitor; ?>
										</td>
									</tr>
									<?php
								}
							}
						}
					?>
				</tbody>
			</table>
			<div class="col s12">
				<span class="<?php echo $colorMessages;?>"><?php echo $postMessages;?></span>
			</div>
			<div id="modalDelVisitorItems" class="modal">
				<div class="modal-content">
					<h4>Deleting Confirmation</h4>
					<h5>Are you sure want to delete selected item(s) ?</h5>
				</div>
				<div class="modal-footer col s12 mb-50">
					<button type="submit" name="btnDeleteVisitor" class="waves-effect waves-light btn green darken-4 right">Yes</button>
					<a href="#!" class="modal-action modal-close waves-effect waves-light btn blue darken-4 right">Cancel</a>
				</div>
			</div>
		</form>
	</div>
</div>