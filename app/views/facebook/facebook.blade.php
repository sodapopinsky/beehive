@extends('layouts.base')
@section('css')
<link href="css/custom.css" rel="stylesheet" />  
@stop


@section('pageContent')

<div class="cl-mcont">		

	<div class="row">
		<div class="col-md-12">
			<div class="block-flat">
			<button class="btn btn-primary pull-right" type="button">Share an Idea</button>
				<div class="header">
					<h3>Post Ideas</h3>

				</div>

				<div class="content">
					<table class="no-border">
						<thead class="no-border">
							<tr>
								<th style="width:50%;">Task</th>
								<th>Date</th>
								<th class="text-right">Amount</th>
							</tr>
						</thead>
						<tbody class="no-border-x no-border-y">
							<tr>
								<td style="width:30%;">Filet Mignon</td>
								<td>05/14/2013</td>
								<td class="text-right">$5,230.000</td>
							</tr>
							<tr>
								<td style="width:30%;">Blue beer</td>
								<td>16/08/2013</td>
								<td class="text-right">$5,230.000</td>
							</tr>
							<tr>
								<td style="width:30%;">T-shirts</td>
								<td>22/12/2013</td>
								<td class="text-right">$5,230.000</td>
							</tr>
						</tbody>
					</table>
				</div>

			</div>
			




		</div>


	</div>
	<!-- End Row -->

</div>



@stop