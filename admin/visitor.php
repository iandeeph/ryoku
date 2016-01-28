<div class="row">
	<div class="col s12 border-bottom grey lighten-2 mb-50">
		<h3 class="left-align">Visitor Messages</h3>
	</div>
	<div class="col s12">
		<form action="#" method="post" enctype="multipart/form-data">
			<div class="col s12 mb-30">
				<a class="waves-effect waves-light btn red accent-4 disabled"><i class="material-icons left">delete</i>Delete</a>
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
						if($resultVisitorQry = mysqli_query($conn, "SELECT *, DATE_FORMAT(datePost, '%d/%m/%Y %h:%i') as datepost FROM visitor")){
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
												<input type="checkbox" id="<?php echo $idvisitor; ?>" />
												<label for="<?php echo $idvisitor; ?>"></label>
											</p>
										</td>
										<td>
											<?php echo date($dateVisitor); ?>
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
		</form>
	</div>
</div>