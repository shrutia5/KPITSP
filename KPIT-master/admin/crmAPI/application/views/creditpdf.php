<style type="text/css">
	body { 
	    font-family: serif; 
	    font-size: 8pt; 
	}
	table tr td {margin:0px;}
	.half{
		width: 50%;
	}
	.border-top{
		border-top-style:solid;border-top-width:1px;
	}
	.border-right{
		border-right-style:solid;border-right-width:1px;
	}
	.border-bottom{
		border-bottom-style:solid;border-bottom-width:1px;
	}
	.border-left{
		border-left-style:solid;border-left-width:1px;
	}
	.borderAll td,.borderAll th{
		border-style:solid;border-width:1px;
	}
	.borderBottom td,.borderBottom th{
		border-bottom-style:solid;border-bottom-width:1px;
		padding:4px;
	}
	.srNo{
		width: 10%;
		text-align:center;
		
	}
	.desc{
			width: 40%;
  	}
  	.qut{
			width: 20%;
  	}
  	.unit{
			width: 10%;
  	}
  	.rate{
			width: 15%;
  	}
  	.amt{
			width: 15%;
  	}
  	.text-center{
  		text-align: center;
  	}
	.text-left{
  		text-align: left;
  	}
  	.text-right{
  		text-align: right;
  	}
  	.items tr {

  	}
</style>
<div style="padding-top: 105px;"><h2 align="center"><strong>CREDIT NOTE</strong></h2></div><br>
<table width="100%" style="border:1px solid black;">
	<tbady>
		<tr>
			<td class="half">
				<table>
					<tr>
						<td><h2><strong>Credit Note No:</strong></td><td><?php echo $creditNoteDetails[0]->creditNumber; ?></h3></td>
					</tr>
				</table>
			</td>
			<td class="half">
				<table>
					<tr>
						<td><h2><strong>Credit Note Date:</strong></td><td><?php echo date("d F Y", strtotime($creditNoteDetails[0]->creditDate)); ?></h3></td>
					</tr>
				</table>
			</td>
		</tr>
	</tbady>
</table>
<table width="100%" style="border:1px solid black;">
	<tbady>
		<tr>
			<td class="half" class="border-right">
				<table>
					<tr style="border:1px solid black;">
						<td><strong>Client Details</strong></td>
					</tr>
					<tr>
						<td><strong><?php echo $companyDetails[0]->companyBillingName; ?></strong></td>
					</tr>
					<tr >
						<td><?php echo $companyDetails[0]->companyAddress; ?></td>
					</tr>
				</table>
				<table width="100%">
					<tr>
						<td><strong>GST NO.:</strong></td><td><?php echo $companyDetails[0]->companyGstNo; ?></td>
					</tr>
					<tr>
						<td><strong>PAN:</strong></td><td><?php echo $companyDetails[0]->companyPanNo; ?></td>
					</tr>
						
					<tr>
						<td><strong>Processed Month:</strong></td><td>
							<?php if($creditNoteDetails[0]->processingMonth !='' && $creditNoteDetails[0]->processingYear !='' ) { echo $creditNoteDetails[0]->processingMonth."-".$creditNoteDetails[0]->processingYear; } else{ echo "-";} ?></td>
					</tr>	
								
				</table>
			</td>
			<td class="half">
				<table width="100%">
					<tr>
						<td><strong>Company Details</strong></td>
					</tr>
					<tr>
						<td><strong>GST NO.:</strong></td><td><?php echo $infoSettings[0]->gstNo; ?></td>
					</tr>
					<tr>
						<td><strong>PAN :</strong></td><td><?php echo $infoSettings[0]->panNo; ?></td>
					</tr>
					<tr>
						<td><strong>SAC Code:</strong></td><td><?php echo $infoSettings[0]->sacCode; ?></td>
					</tr>
					<tr >
						<td><strong>Zone:</strong></td><td><?php echo $infoSettings[0]->zone; ?></td>
					</tr>
					<tr >
						<td><strong>Category of Services:</strong></td><td><?php echo $infoSettings[0]->neemTrainees; ?></td>
					</tr>
					<tr>
						<td><strong>Place of Supply:</strong></td><td><?php echo $companyDetails[0]->stateName; ?></td>
					</tr>	
				</table>
			</td>
		</tr>
	</tbady>
</table>
<table width="100%" style="border:1px solid black;" class="items">
	<tbody>
	<tr class="borderBottom">
      <th class="srNo text-left">SR No.</th>
      <th class="desc text-left">Description</th>
      <th class="qut text-left">Quantity</th>
      <th class="unit text-left">Unit</th>
      <th class="rate text-right">Rate</th>
      <th class="amt text-right">Amount</th>
    </tr>
<?php 
    foreach ($creditLineDetails as $key => $value) {
    ?>
    <tr class="borderBottom">
		<td class="srNo border-right"><?php echo $value->srNo; ?></td>
		<td class="type border-right text-left"><?php echo $value->creditLineNarr; ?></td>
		<td class="qut border-right text-left"><?php echo number_format($value->creditLineQty,2, '.', ''); ?></td>
		<td class="unit border-right text-left"><?php echo $value->creditLineUnit; ?></td>
		<td class="rate border-right text-right"><?php echo number_format($value->creditLineRate,2, '.', ''); ?></td>
		<td class="amt text-right"><?php echo number_format($value->creditLineAmount,2, '.', ''); ?></td>
    </tr>
    <?php } ?>
   </tbady>
</table>
<table width="100%" style="border:1px solid black;">
	<tbady>
		<tr>
			<td class="half">
				<table width="100%">
					<tr>
						<td><h5>Amount in words:</h5></td>
					</tr>
					<tr>
						<td><?php echo $this->CommonModel->num2words(round($creditNoteDetails[0]->grossAmount),"INR");?></td>
					</tr>
					<!-- <tr>
						<td><hr><h5>Bank Details:</h5></td>
					</tr>
					<tr>
						<td><strong>Bank Name:</strong> <?php echo $infoSettings[0]->bankAndBranch; ?></td>
					</tr>
					<tr>
						<td><strong>Bank A/C No.:</strong> <?php echo $infoSettings[0]->bankAccNo; ?></td>
					</tr>
					<tr>
						<td><strong>Bank IFSC:</strong> <?php echo $infoSettings[0]->ifscCode; ?></td>
					</tr>
					<tr>
						<td><strong>MICR Code:</strong> <?php echo $infoSettings[0]->mcirCode; ?></td>
					</tr> -->
				</table>
			</td>
			<td class="half border-left">
				<table width="100%">
					<tr class="borderBottom">
						<td class="text-left"><strong>Sub Total:</strong></td>
						<td class="text-right"><?php echo number_format($creditNoteDetails[0]->creditTotal,2, '.', ''); ?></td>
					</tr>		
					<?php if($creditNoteDetails[0]->stateGstAmount !=0 && $creditNoteDetails[0]->stateGstAmount != null){?>
					<tr class="borderBottom">
						<td class="text-left"><strong>S-GST (<?php echo $creditNoteDetails[0]->stateGstPercent; ?>%):</strong></td>
						<td class="text-right"><?php echo number_format($creditNoteDetails[0]->stateGstAmount,2, '.', ''); ?></td>
					</tr>	
					<?php } ?>
					<?php if($creditNoteDetails[0]->centralGstAmount !=0 && $creditNoteDetails[0]->centralGstAmount != null){?>
					<tr class="borderBottom">
						<td class="text-left"><strong>C-GST (<?php echo $creditNoteDetails[0]->centralGstPercent; ?>%):</strong></td>
						<td class="text-right"><?php echo number_format($creditNoteDetails[0]->centralGstAmount,2, '.', ''); ?></td>
					</tr>	
					<?php } ?>
					<?php if($creditNoteDetails[0]->interGstAmount !=0 && $creditNoteDetails[0]->interGstAmount != null){?>
					<tr class="borderBottom">
						<td class="text-left"><strong>I-GST (<?php echo $creditNoteDetails[0]->interGstPercent; ?>%):</strong></td>
						<td class="text-right"><?php echo number_format($creditNoteDetails[0]->interGstAmount,2, '.', ''); ?></td>
					</tr>	
					<?php } ?>
					<?php if($creditNoteDetails[0]->roundOff !=0){?>
					<tr class="borderBottom">
						<td class="text-left"><strong>Round Off:</strong></td>
						<td class="text-right"><?php echo number_format($creditNoteDetails[0]->roundOff,2, '.', ''); ?></td>
					</tr>		
					<?php } ?>
					<tr class="">
						<td class="text-left"><strong>Gross Total:</strong></td>
						<td class="text-right"><?php echo number_format($creditNoteDetails[0]->grossAmount,2, '.', ''); ?></td>
					</tr>	
					
				</table>
			</td>
		</tr>
	</tbady>
</table>
<table width="100%" style="border:1px solid black;">
	<tbady>
		<tr>
			<td class="border-top">
				<strong>Terms and Conditions</strong>
			</td>
		</tr>
		<tr>
			<td>
				<?php echo $infoSettings[0]->termsConditions; ?>
			</td>
		</tr>
		<tr>
			<td align="right"><br>
				<strong>Authorized Signatory</strong>
			</td>
		</tr>
	</tbady>
</table>
