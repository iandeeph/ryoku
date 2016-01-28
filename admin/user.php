<div class="row">
	<div class="col s12 border-bottom grey lighten-2 mb-50">
		<h3 class="left-align">Manage User</h3>
	</div>
	<div class="col s12">
		<form action="#" method="post" enctype="multipart/form-data">
			<div class="col s12 mb-30">
				<a class="waves-effect waves-light btn red accent-4 disabled"><i class="material-icons left">delete</i>Delete</a>
				<a class="waves-effect waves-light btn blue darken-4 disabled"><i class="material-icons left">edit</i>edit</a>
				<a class="btn-floating btn-large waves-effect waves-light green darken-4 right"><i class="material-icons">add</i></a>
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
							Username
						</td>
						<td>
							Password
						</td>
						<td>
							First Name
						</td>
						<td>
							Last Name
						</td>
						<td>
							Email
						</td>
						<td>
							Permission
						</td>
					</tr>
				</thead>
				<tbody>
					<?php
						if($resultUserQry = mysqli_query($conn, "SELECT * FROM user")){
							if (mysqli_num_rows($resultUserQry) > 0) {
								while ($rowUser = mysqli_fetch_array($resultUserQry)) {
									$iduser         = $rowUser['iduser'];
									$username       = $rowUser['username'];
									$passwordUser 	= $rowUser['password'];
									$firstNameUser  = $rowUser['firstName'];
									$lastNameUser   = $rowUser['lastName'];
									$email 			= $rowUser['email'];
									$privilege 		= $rowUser['privilege'];
									?>
									<tr>
										<td>
											<p>
												<input type="checkbox" id="<?php echo $iduser; ?>" />
												<label for="<?php echo $iduser; ?>"></label>
											</p>
										</td>
										<td>
											<?php echo $username; ?>
										</td>
										<td>
											<?php echo $passwordUser; ?>
										</td>
										<td>
											<?php echo $firstNameUser; ?>
										</td>
										<td>
											<?php echo $lastNameUser; ?>
										</td>
										<td>
											<?php echo $email; ?>
										</td>
										<td>
											<?php echo $privilege; ?>
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